<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../model/Article.php';

/* Homepage */
$app->get('/', function ($request, $response) {
	$vars = [
		'page' => [
			'title' => 'Owl In One'
		],
	];
	return $this->view->render($response, 'home.html', $vars);
});

/* GET all articles */
$app->get('/articles', function ($request, $response) {
	try {
		$articles = Article::readMany();
		$vars = [
			'articles' => (array) $articles
		];
		return $this->view->render($response, 'articles_list.html', $vars);

	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/* GET Single article */
$app->get('/articles/{id:[0-9]+}', function ($request, $response, $args) {
	$id = $args['id'];

	try {
		$article = Article::read($id);
		$vars = [
			'article' => (array) $article
		];
		return $this->view->render($response, 'article.html', $vars);

	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/* New article template */
$app->get('/articles/new', function($request, $response) {
	return $this->view->render($response, 'article_new.html');
});

/* New article insert */
$app->post('/articles/new', function($request, $response, $args) {
	$title = $request->getParam('title');
	$body = $request->getParam('body');

	try {
		Article::create($title, $body);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});

/* New article delete */
$app->delete('/articles/delete/{id:[0-9]+}', function($request, $response, $args) {
	$id = $args['id'];

	try {
		Article::delete($id);
	} catch(PDOException $e) {
		echo '{"error": {"text": '.$e->getMessage().'}';
	}
});
