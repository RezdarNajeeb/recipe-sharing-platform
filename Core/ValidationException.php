<?php

namespace Core;

use Exception;

class ValidationException extends Exception
{
    public array $errors;
    public array $old;

    public static function throw($errors, $old): ValidationException
    {
        $instance = new static();

        $instance->errors = $errors;
        $instance->old = $old;

        return throw $instance;
    }
}