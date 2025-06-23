<?php

namespace Core\Middleware;

use Exception;

class Middleware
{
    public const array MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve(?array $keys): void
    {
        if (!$keys) {
            return;
        }

        // Our keys are number indexed array, and we want to take the values as keys so we need to flip it, then through
        // array_intersect_key we find the ones that requested, and we take them out from our MAP.
        $middlewares = array_intersect_key(self::MAP, array_flip($keys));

        if (!$middlewares) {
            throw new Exception("There is not any middleware with the keys: " . implode(', ', $keys));
        }

        foreach ($middlewares as $middleware) {
            new $middleware()->handle();
        }
    }
}