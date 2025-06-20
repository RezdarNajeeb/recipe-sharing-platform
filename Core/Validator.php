<?php

namespace Core;

class Validator
{
    public static function string(string $value, int $min = 1, int|float $max = INF): bool
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }
}