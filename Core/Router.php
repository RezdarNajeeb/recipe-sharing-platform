<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Router
{
    public array $routes = [];

    public function get(string $url, array $controller): void
    {
        $this->add($url, $controller, 'GET');
    }

    public function post(string $url, array $controller): void
    {
        $this->add($url, $controller, 'POST');
    }

    public function put(string $url, array $controller): void
    {
        $this->add($url, $controller, 'PUT');
    }

    public function delete(string $url, array $controller): void
    {
        $this->add($url, $controller, 'DELETE');
    }

    public function add(string $url, array $controller, string $method): void
    {
        extract($controller);

        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function route(string $url, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] === strtoupper($method)) {
                $class = key($route['controller']);
                $func = $route['controller'][$class];
                new $class()->$func();

                return;
            }
        }
        abort();
    }

    public static function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}