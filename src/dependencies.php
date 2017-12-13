<?php

use App\middleware\Auth;

// Custom Authentication Middleware
require __DIR__ . '/../src/middleware/Auth.php';

// Get the container
$container = $app->getContainer();

// Twig view dependency
$container['view'] = function ($c)
{
	$conf = $c->get('settings')['view'];
	$view = new \Slim\Views\Twig($conf['path'], $conf['twig']);
	$basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
	$view->addExtension(new \Slim\Views\TwigExtension(
		$c['router'],
		$basePath
	));

	return $view;
};

// Flash messages between views
$container['flash'] = function ()
{
    return new \Slim\Flash\Messages();
};

// Auth middleware
$container['Auth'] = function ($c)
{
	return new App\middleware\Auth($c['router']);
};
