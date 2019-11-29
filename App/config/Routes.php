<?php

declare(strict_types=1);

require __DIR__ . '/../../Core/Router.php';

$router = Core\Router::getInstance(true);

//$router->add('/', ['controller' => 'IndexController::index', 'method' => 'GET']);
//$router->add('/posts', ['controller' => 'PostController::index', 'method' => 'GET']);
//$router->add('/posts/new', ['controller' => 'PostController::new', 'method' => 'POST']);

$router->callController($_SERVER['REQUEST_URI']);