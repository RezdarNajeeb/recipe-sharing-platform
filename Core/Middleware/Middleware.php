<?php

namespace Core\Middleware;

use Exception;

class Middleware
{
    public const array MAP = [
        'guest' => Guest::class,
        'auth' => Auth::class
    ];

    public static function resolve(?string $key): void
    {
        if (!$key) {
            return;
        }

        $middleware = self::MAP[$key] ?? false;

        if (!$middleware) {
            throw new Exception("There is not any middleware with the key: '$key'");
        }

        new $middleware()->handle();
    }
}