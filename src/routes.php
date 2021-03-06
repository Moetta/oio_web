<?php

require __DIR__ . '/model/Article.php';
require __DIR__ . '/model/ArticleCategory.php';
require __DIR__ . '/model/Apartment.php';
require __DIR__ . '/model/Event.php';
require __DIR__ . '/model/Bugs.php';

/************
 * HOMEPAGE *
*************/
$app->get('/', function ($request, $response, $args)
{
	$vars = [
		'page_title' => 'Owl In One',
		'session' => $_SESSION['active'] ?? false,
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
		return $res->withRedirect($this->router->pathFor('home'));
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
})->setName('articles')->add('Auth');

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
})->setName('newArticle')->add('Auth');

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
})->add('Auth');

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
		Article::update($pdo, $id, $data);
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

/* GET all categories */
$app->get('/categories', function ($req, $res)
{
	try {
		$pdo = $this->PDO;
		$categories = ArticleCategory::readMany($pdo);
		$vars = [
			'page_title' => 'Toutes les catégories',
			'session' => $_SESSION['active'],
			'categories' => (array) $categories
		];
		return $this->view->render($res, 'categories_list.html', $vars);

	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->setName('categories')->add('Auth');

/* New Category INSERT */
$app->post('/categories/new', function($req, $res, $args)
{
	$data = [
		'name' => $req->getParsedBodyParam('name')
	];

	try {
		$pdo = $this->PDO;
		ArticleCategory::create($pdo, $data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* Category PUT */
$app->put('/categories/edit/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];
	$data = [
		'name' => $req->getParsedBodyParam('name')
	];

	try {
		$pdo = $this->PDO;
		ArticleCategory::update($pdo, $id, $data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* Category DELETE */
$app->delete('/categories/delete/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	try {
		$pdo = $this->PDO;
		ArticleCategory::delete($pdo, $id);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/**************
 * APARTMENTS *
***************/

/* GET all apartments */
$app->get('/apartments', function ($req, $res)
{
	try {
		$pdo = $this->PDO;
		$vars = [
			'page_title' => 'Liste des appartements',
			'session' => $_SESSION['active']
		];
		return $this->view->render($res, 'apartments_list.html', $vars);

	} catch(PDOException $e) {
		error_log( '{"error": {"text": '.$e->getMessage().'}' );
	}
})->setName('apartments')->add('Auth');

/* GET Single apartment */
$app->get('/apartments/{id:[0-9]+}', function ($req, $res, $args)
{
	$id = $args['id'];

	try {
		$pdo = $this->PDO;
		$apartment = Apartment::read($pdo, $id);
		$vars = [
			'page_title' => $apartment->DESCRIP_APPART,
			'session' => $_SESSION['active'],
			'apartment' => (array) $apartment
		];
		return $this->view->render($res, 'apartment.html', $vars);

	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* New Apartment template */
$app->get('/apartments/new', function($req, $res)
{
 	$vars = [
		'page_title' => 'Nouvel appartement',
		'session' => $_SESSION['active']
	];
	return $this->view->render($res, 'apartment_new.html', $vars);
})->setName('newApartment')->add('Auth');

/* New apartment INSERT */
$app->post('/apartments/new', function($req, $res, $args)
{
	$data = [
		'description' 	=> $req->getParsedBodyParam('description'),
		'price' 		=> $req->getParsedBodyParam('price'),
		'details' 		=> $req->getParsedBodyParam('details'),
		'address' 		=> $req->getParsedBodyParam('address'),
		'city' 			=> $req->getParsedBodyParam('city'),
		'postalcode' 	=> $req->getParsedBodyParam('postalcode'),
		'owner' 		=> $req->getParsedBodyParam('owner'),
		'phone' 		=> $req->getParsedBodyParam('phone'),
		'email' 		=> $req->getParsedBodyParam('email'),
		'lat' 			=> $req->getParsedBodyParam('lat'),
		'lng' 			=> $req->getParsedBodyParam('lng')
	];

	try {
		$pdo = $this->PDO;
		Apartment::create($pdo, $data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* Apartment Edit template */
$app->get('/apartments/edit/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	try {
		$pdo = $this->PDO;
		$apartment = Apartment::read($pdo, $id);
		$vars['page_title'] = 'Éditer appartement';
		$vars['apartment'] = (array) $apartment;
		$vars['session'] = $_SESSION['active'];
		return $this->view->render($res, 'apartment_edit.html', $vars);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* Apartment PUT */
$app->put('/apartments/edit/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];
	$data = [
		'description' 	=> $req->getParsedBodyParam('description'),
		'price' 		=> $req->getParsedBodyParam('price'),
		'details' 		=> $req->getParsedBodyParam('details'),
		'address' 		=> $req->getParsedBodyParam('address'),
		'city' 			=> $req->getParsedBodyParam('city'),
		'postalcode' 	=> $req->getParsedBodyParam('postalcode'),
		'owner' 		=> $req->getParsedBodyParam('owner'),
		'phone' 		=> $req->getParsedBodyParam('phone'),
		'email' 		=> $req->getParsedBodyParam('email'),
		'status' 		=> $req->getParsedBodyParam('status'),
		'reported' 		=> $req->getParsedBodyParam('reported'),
		'validation' 	=> $req->getParsedBodyParam('validation'),
		'lat' 			=> $req->getParsedBodyParam('lat'),
		'lng' 			=> $req->getParsedBodyParam('lng')
	];

	try {
		$pdo = $this->PDO;
		Apartment::update($pdo, $id, $data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* Apartment DELETE */
$app->delete('/apartments/delete/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	try {
		$pdo = $this->PDO;
		Apartment::delete($pdo, $id);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/**********
 * EVENTS *
***********/

/* GET all events */
$app->get('/events', function ($req, $res)
{
	try {
		$pdo = $this->PDO;
		$events = Event::readMany($pdo);
		foreach($events as $event) {
			$event->DEBUT_EVENEMENT = str_replace(' ', 'T', $event->DEBUT_EVENEMENT);
		}
		$vars = [
			'page_title' => 'Liste des évènements',
			'session' => $_SESSION['active'],
			'events' => (array) $events
		];
		return $this->view->render($res, 'events_list.html', $vars);

	} catch(PDOException $e) {
		print_r( '{"error": {"text": '.$e->getMessage().'}' );
	}
})->setName('events')->add('Auth');

/* New event INSERT */
$app->post('/events/new', function($req, $res, $args)
{
	$data = [
		'name' 			=> $req->getParsedBodyParam('name'),
		'start' 		=> $req->getParsedBodyParam('start'),
		'link' 			=> $req->getParsedBodyParam('link'),
		'location' 		=> $req->getParsedBodyParam('location')
	];

	$pdo = $this->PDO;
	Event::create($pdo, $data);

})->add('Auth');

/* Event PUT */
$app->put('/events/edit/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];
	$data = [
		'name' 			=> $req->getParsedBodyParam('name'),
		'start' 		=> $req->getParsedBodyParam('start'),
		'link' 			=> $req->getParsedBodyParam('link'), 
		'location' 		=> $req->getParsedBodyParam('location')
	];

	try {
		$pdo = $this->PDO;
		Event::update($pdo, $id, $data);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/* Event DELETE */
$app->delete('/events/delete/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	try {
		$pdo = $this->PDO;
		Event::delete($pdo, $id);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
})->add('Auth');

/********
 * BUGS *
*********/

/* Bugs template */
$app->get('/bugs', function($req, $res)
{
	try {
		$pdo = $this->PDO;
		$bugs = Bugs::getBugs($pdo);
		$suggestions = Bugs::getSuggestions($pdo);
		$apartments = Bugs::getReportedApartments($pdo);
		$users = Bugs::getUsers($pdo);
		$vars = [
			'page_title' => 'Gestion des bugs',
			'session' => $_SESSION['active'],
			'bugs' => (array) $bugs,
			'suggestions' => (array) $suggestions,
			'apartments' => (array) $apartments,
			'users' => (array) $users
		];
		return $this->view->render($res, 'bugs_list.html', $vars);

	} catch(PDOException $e) {
		print_r( '{"error": {"text": '.$e->getMessage().'}' );
	}
})->setName('bugs')->add('Auth');

/* User DELETE */
$app->delete('/users/delete/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];

	$pdo = $this->PDO;
	Bugs::deleteUser($pdo, $id);
})->add('Auth');

/* Bug PUT (resolve) */
$app->put('/bugs/resolve/{id:[0-9]+}', function($req, $res, $args)
{
	$id = $args['id'];
	$data = [
		'active' => $req->getParsedBodyParam('active')
	];

	$pdo = $this->PDO;
	Bugs::resolveBug($pdo, $id, $data);
})->add('Auth');

/**********
 * SEARCH *
***********/

$app->get('/apartments/search/{filter}[/{keyword}]', function($req, $res, $args)
{
	$filter = $args['filter'];
	$keyword = $args['keyword'] ?? NULL;
	$pdo = $this->PDO;
	$apartments = Apartment::search($pdo, $filter, $keyword);
	$vars = [
		'apartments' => (array) $apartments
	];
	return $this->view->render($res, 'apartments_tpl.html', $vars);
})->add('Auth');











