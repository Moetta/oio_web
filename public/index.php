<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Slim vendor
require __DIR__ . '/../vendor/autoload.php';

// Database connexion
//require __DIR__ . '/../src/db.php';

//ini_set('session.cookie_lifetime', 0);
//ini_set('session.use_cookies', 1);
//ini_set('session.use_only_cookies', 1);
//ini_set('session.use_strict_mode', 1); ??
//ini_set('session.cookie_httponly', 1);
//ini_set('session.cookie_secure', 1);
//ini_set('session.gc_maxlifetime', 60 * 60 * 24);
//ini_set('session.gc_probability', 1);
//ini_set('session.gc_divisor', 1);
//ini_set('session.use_trans_sid', 0);
//ini_set('session.sid_length', 48);
//ini_set('session.sid_bits_per_character', 6);

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
