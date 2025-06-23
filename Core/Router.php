<?php

namespace Core;

use Core\Middleware\Middleware;

class Router
{
    public array $routes = [];

    public function get(string $url, array $controller): self
    {
        return $this->add($url, $controller, 'GET');
    }

    public function post(string $url, array $controller): self
    {
        return $this->add($url, $controller, 'POST');
    }

    public function put(string $url, array $controller): self
    {
        return $this->add($url, $controller, 'PUT');
    }

    public function delete(string $url, array $controller): self
    {
        return $this->add($url, $controller, 'DELETE');
    }

    public function add(string $url, array $controller, string $method): self
    {
        extract($controller);

        $this->routes[] = [
            'url' => $url,
            'controller' => $controller,
            'method' => $method,
            'middleware' => []
        ];

        return $this;
    }

    private function addToMiddlewares(array $middlewares, ?int $urlIndex = null): void
    {
        array_push($this->routes[$urlIndex ?? array_key_last($this->routes)]['middleware'], ...$middlewares);
    }

    public function guest(): self
    {
        $this->addToMiddlewares(['guest']);

        return $this;
    }

    public function auth(): self
    {
        $this->addToMiddlewares(['auth']);

        return $this;
    }

    public function middleware(array $keys): self
    {
        $this->addToMiddlewares($keys);

        return $this;
    }

    public function group(array $options, callable $function): self
    {
        $beforeCount = count($this->routes);

        call_user_func($function);

        if (array_key_exists('middleware', $options)) {
            for ($i = $beforeCount; $i <= array_key_last($this->routes); $i++) {
                $this->addToMiddlewares($options['middleware'], $i);
            }
        }

        return $this;
    }

    public function route(string $url, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                $class = key($route['controller']);
                $func = $route['controller'][$class];
                new $class()->$func();

                return;
            }
        }
        abort();
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }
}