<?php

require __DIR__ . '/model/Article.php';
require __DIR__ . '/model/ArticleCategory.php';

/* Homepage */
$app->get('/', function ($request, $response, $args)
{
	$vars = [
		'page_title' => 'Owl In One',
		'session' => $_SESSION['active'],
		'flash_messages' => $this->flash->getMessages()
	];
	return $this->view->render($response, 'home.html', $vars);
})->setName('home');

/* Login POST from home.html */
$app->post('/login', function ($req, $res, $args)
{
	$username = $req->getParsedBodyParam('username');
	$password = $req->getParsedBodyParam('password');
	
	$pdo = $this->PDO;
	$sql = "SELECT id FROM tab_users WHERE username = :username AND password = :password";
	$statement = $pdo->prepare($sql);
	$statement->execute(array(':username' => $username, ':password' => $password));
	$user = $statement->fetch(PDO::FETCH_OBJ);

	if ($user) {
    	$_SESSION['active'] = true;
		session_regenerate_id();
        // Login success, redirect to the dashboard.
		$this->flash->addMessage('login', 'Connexion réussie.');
		return $res->withRedirect($this->router->pathFor('new'));
    }
	// Login failed, redirect home.
	$this->flash->addMessage('login', 'Identifiants incorrects.');
	return $res->withRedirect($this->router->pathFor('home'));
});

/* Logout from session */
$app->get('/logout', function ($req, $res, $args)
{
	session_destroy();
    return $res->withRedirect($this->router->pathFor('home'));
});

/************
 * ARTICLES *
*************/

/* GET all articles */
$app->get('/articles', function ($req, $res)
{
	try {
		$pdo = $this->PDO;
		$articles = Article::readMany($pdo);
		foreach ($articles as $article) {
			$article->CATEGORIE_ARTICLE = ArticleCategory::read($pdo, $article->CATEGORIE_ARTICLE)->LIBELLE_CATEGORIE;
		}
		$vars = [
			'page_title' => 'Tous les articles',
			'session' => $_SESSION['active'],
			'articles' => (array) $articles
		];
		return $this->view->render($res, 'articles_list.html', $vars);

	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->setName('articles');

/* GET Single article */
$app->get('/articles/{id:[0-9]+}', function ($req, $res, $args)
{
	$id = $args['id'];

	try {
		$pdo = $this->PDO;
		$article = Article::read($pdo, $id);
		$article->CATEGORIE_ARTICLE = ArticleCategory::read($pdo, $article->CATEGORIE_ARTICLE)->LIBELLE_CATEGORIE;
		$vars = [
			'page_title' => $article->TITRE_ARTICLE,
			'session' => $_SESSION['active'],
			'article' => (array) $article
		];
		return $this->view->render($res, 'article.html', $vars);

	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/* New article template */
$app->get('/articles/new', function($req, $res)
{
	try {
		$pdo = $this->PDO;
		$categories = ArticleCategory::readMany($pdo);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
 	$vars = [
		'page_title' => 'Nouvel article',
		'session' => $_SESSION['active'],
		'categories' => (array) $categories
	];
	return $this->view->render($res, 'article_new.html', $vars);
})->setName('new')->add('Auth');

/* New article INSERT */
$app->post('/articles/new', function($req, $res, $args)
{
	$data = [
		'title' => $req->getParsedBodyParam('title'),
		'body' => $req->getParsedBodyParam('body'),
		'category' => $req->getParsedBodyParam('category'),
		'img64' => $req->getParsedBodyParam('img64')
	];

	try {
		$pdo = $this->PDO;
		Article::create($pdo, $data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* Article Edit template */
$app->get('/articles/edit/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	try {
		$pdo = $this->PDO;
		$article = Article::read($pdo, $id);
		$category = ArticleCategory::read($pdo, $article->CATEGORIE_ARTICLE);
		$categories = ArticleCategory::readMany($pdo);
		$vars['page_title'] = 'Éditer article';
		$vars['article'] = (array) $article;
		//$vars['category'] = (array) $category;
		$vars['categories'] = (array) $categories;
		$vars['session'] = $_SESSION['active'];
		//print_r($vars);
		return $this->view->render($res, 'article_edit.html', $vars);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/* Article PUT */
$app->put('/articles/edit/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];
	$data = [
		'title' => $req->getParsedBodyParam('title'),
		'body' => $req->getParsedBodyParam('body'),
		'category' => $req->getParsedBodyParam('category'),
		'img64' => $req->getParsedBodyParam('img64')
	];

	try {
		$pdo = $this->PDO;
		$article = Article::update($pdo, $id, $data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* Article DELETE */
$app->delete('/articles/delete/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	try {
		$pdo = $this->PDO;
		Article::delete($pdo, $id);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/**************
 * CATEGORIES *
***************/
