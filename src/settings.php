<?php
return [
	'settings' => [
		'displayErrorDetails' => true, // Set to false in production
		
		// Slim view settings
		'view' => [
			'path' => __DIR__ . '/../templates',
			'twig' => ['cache' => false]
		],
	 ]
];
