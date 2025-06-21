<?php

namespace Core;

use Exception;

class Container
{
    protected array $bindings;
    public function bind(string $key, callable $resolver): void
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve(string $key): mixed
    {
        if (!array_key_exists($key, $this->bindings)) {
            return throw new Exception("There is no bindings for the key: $key");
        }

        return call_user_func($this->bindings[$key]);
    }
}