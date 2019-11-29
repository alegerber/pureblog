<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
    /**
     * @var Router
     */
    private static $instance;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @var array $routes
     */
    private $routes = [];

    /**
     * @param $route
     * @param $params
     */
    public function add(string $route, array $params): void
    {
        $this->routes[$route] = $params;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param string $requestUri
     * @return null|array
     */
    public function match(string $requestUri): ?array
    {
        foreach ($this->routes as $route => $params){
            if($route === $requestUri){
                return $params;
            }
        }
        return null;
    }

    /**
     * @param string $requestUri
     */
    public function callController(string $requestUri): void
    {
        if(null !== $params = $this->match($requestUri)){
            $controller = \explode('::', $params['controller']);

            $className = '\\App\\Controllers\\' . $controller[0];
            $class = new $className();
            $action = $controller[1];

            echo (string) $class->$action();
        } else {
            var_dump($requestUri);
            echo 'route not found';
            //throw new RouteException('route not found');
        }
    }
}
