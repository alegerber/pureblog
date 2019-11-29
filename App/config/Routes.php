<?php

declare(strict_types=1);

require __DIR__ . '/../../Core/Router.php';

$router = App\Core\Router::getInstance();

//$router->add('/', ['controller' => 'HomeController::index', 'method' => 'GET']);
//$router->add('/posts', ['controller' => 'PostController::index', 'method' => 'GET']);
//$router->add('/posts/new', ['controller' => 'PostController::new', 'method' => 'POST']);

$router->callController($_SERVER['REQUEST_URI']);