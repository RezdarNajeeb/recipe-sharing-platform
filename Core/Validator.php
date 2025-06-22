<?php

namespace Core;

class Validator
{
    public static function string(string $value, int $min = 1, int|float $max = INF): bool
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email(string $value): string|bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function password(string $value): false|int
    {
        // Returns 1 if the pattern matches given subject, 0 if it does not, or FALSE if an error occurred.
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $value);
    }
}