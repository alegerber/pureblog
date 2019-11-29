<?php

declare(strict_types=1);

namespace Core;

class Router
{

    private const CONTROLLER_INDEX   = 0;
    private const ACTION_INDEX       = 1;
    private const DEFAULT_CONTROLLER = 'IndexController';
    private const DEFAULT_ACTION     = 'index';

    /**
     * @var Router
     */
    private static $instance;

    /**
     * @var array $routes
     */
    private $routes = [];

    /**
     * @var bool
     */
    private $autoRouting = false;

    /**
     * gets the instance via lazy initialization (created on first usage)
     *
     * @param bool $autoRouting
     * @return self
     */
    public static function getInstance(bool $autoRouting): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        if ($autoRouting) {
            static::$instance->setAutoRouting($autoRouting);
        }

        return static::$instance;
    }

    /**
     * @param bool $autoRouting
     */
    public function setAutoRouting(bool $autoRouting): void
    {
        if (!$autoRouting) {
            throw new \BadFunctionCallException('auto routing is enabled, you can\'t disable it');
        }

        if (!$this->autoRouting) {
            $this->autoRouting = $autoRouting;
        }
    }

    /**
     * @param $route
     * @param $params
     */
    public function add(string $route, array $params): void
    {
        if ($this->autoRouting) {
            throw new \BadFunctionCallException('auto routing is enabled, you can\'t add a route');
        }

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
        $controller = [];

        if ($this->autoRouting) {
            if ('/' === $requestUri) {
                $controller[self::CONTROLLER_INDEX] = self::DEFAULT_CONTROLLER;
                $controller[self::ACTION_INDEX]     = self::DEFAULT_ACTION;
            } else {
                $unformattedRoute = explode('/', substr($requestUri, 1));

                $controller[self::CONTROLLER_INDEX] = ucfirst($unformattedRoute[self::CONTROLLER_INDEX]) . 'Controller';

                if (self::CONTROLLER_INDEX === $unformattedRoute) {
                    $controller[self::ACTION_INDEX] = self::DEFAULT_ACTION;
                } else {
                    $controller[self::ACTION_INDEX] = $unformattedRoute[self::ACTION_INDEX];
                }
            }
        } else if (null !== $params = $this->match($requestUri)) {
                $controller = explode('::', $params['controller']);
        } else {
            throw new \BadFunctionCallException('route not found');
        }


        $className = '\\App\\Controller\\' . $controller[self::CONTROLLER_INDEX];
        $class     = new $className();
        $action    = $controller[self::ACTION_INDEX];

        echo (string) $class->$action();
    }
}
