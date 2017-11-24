<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../model/Article.php';

/* Homepage */
$app->get('/', function (Request $request, Response $response) {
     $vars = [
        'page' => [
            'title' => 'Owl In One'
        ],
    ];  
    return $this->view->render($response, 'home.html', $vars);
});

/* GET all articles */
$app->get('/articles', function (Request $request, Response $response) {

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
$app->get('/articles/{id}', function(Request $request, Response $response) {
    $id = $request->getAttribute('id');
    
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
//$app->get('/articles/new', function(Request $request, Response $response) {
//    return $this->view->render($response, 'article_new.html');
//});