<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../app/db.php';

$settings = require __DIR__ . '/../app/settings.php';

$app = new \Slim\App($settings);

require __DIR__ . '/../app/dependencies.php';

require __DIR__ . '/../app/routes/ui.php';

$app->run();

