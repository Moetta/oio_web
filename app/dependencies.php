<?php

// Get the container
$container = $app->getContainer();

// Twig view dependency
$container['view'] = function ($c) {

	$conf = $c->get('settings')['view'];
	$view = new \Slim\Views\Twig($conf['path'], $conf['twig']);
	$basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
	$view->addExtension(new \Slim\Views\TwigExtension(
		$c['router'],
		$basePath
	));

	return $view;
};
