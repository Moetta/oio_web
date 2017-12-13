<?php

require __DIR__ . '/model/Article.php';

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

// Login POST from home.html
$app->post('/login', function ($req, $res, $args)
{
	$username = $req->getParsedBodyParam('username');
	$password = $req->getParsedBodyParam('password');
	
	$db = new db();
	$pdo = $db->connect();
	$sql = "SELECT id FROM tab_users WHERE username = :username AND password = :password";
	$statement = $pdo->prepare($sql);
	$statement->execute(array(':username' => $username, ':password' => $password));
	$user = $statement->fetch(PDO::FETCH_OBJ);
	$db = null;

	if ($user) {
        $_SESSION['active'] = true;
        session_regenerate_id();
        // Login success, redirect to the dashboard.
		$this->flash->addMessage('login', 'Connexion réussie.');
        return $res->withRedirect($this->router->pathFor('new'));
    }
    // Login failed, redirect home.
	$this->flash->addMessage('login', 'Connexion échouée.');
    return $res->withRedirect($this->router->pathFor('home'));
});

// Logout from session
$app->get('/logout', function ($req, $res, $args)
{
	session_destroy();
    return $res->withRedirect($this->router->pathFor('home'));
});

/* GET all articles */
$app->get('/articles', function ($req, $res)
{
	try {
		$articles = Article::readMany();
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
		$article = Article::read($id);
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
 	$vars = [
		'session' => $_SESSION['active'],
		'flash_messages' => $this->flash->getMessages()
	];
	return $this->view->render($res, 'article_new.html', $vars);
})->setName('new')->add('Auth');

/* New article INSERT */
$app->post('/articles/new', function($req, $res, $args)
{
	$data = [
		'title' => $req->getParsedBodyParam('title'),
		'body' => $req->getParsedBodyParam('body'),
	];

	try {
		Article::create($data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/* Article Edit template */
$app->get('/articles/edit/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	try {
		$article = Article::read($id);
		$vars['article'] = (array) $article;
		$vars['session'] = $_SESSION['active'];
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
	];

	try {
		$article = Article::update($id, $data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/* Article DELETE */
$app->delete('/articles/delete/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	try {
		Article::delete($id);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});
