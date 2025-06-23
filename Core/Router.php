<?php

namespace Core;

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
            'middleware' => null
        ];

        return $this;
    }

    public function guest(): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = 'guest';

        return $this;
    }

    public function auth(): self
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = 'auth';

        return $this;
    }

    public function route(string $url, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['url'] === $url && $route['method'] === strtoupper($method)) {
                if ($route['middleware']) {
                    if ($route['middleware'] === 'guest') {
                        if (Session::has('user')) {
                            redirect('/');
                        }
                    }

                    if ($route['middleware'] === 'auth') {
                        if (!Session::has('user')) {
                            redirect('/');
                        }
                    }
                }

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