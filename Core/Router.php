<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    public array $routes = [];

    public function get(string $url, string $controller): void
    {
        $this->add($url, $controller, 'GET');
    }

    public function add(string $url, string $controller, string $method): void
    {
        $this->routes[] = [
            'url' => $url,
            'controller' => "controllers/$controller",
            'method' => $method
        ];
    }

    #[NoReturn] public function route(string $url, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] === strtoupper($method)) {
                require basePath($route['controller']);
            }
        }
        abort();
    }
}