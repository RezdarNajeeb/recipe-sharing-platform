<?php

namespace Core;

use Exception;

class ExceptionHandler extends Exception
{
    public array $errors;
    public array $old;

    public static function throw($errors, $old): ExceptionHandler
    {
        $instance = new static();

        $instance->errors = $errors;
        $instance->old = $old;

        return throw $instance;
    }
}