<?php

namespace App\Http\Forms;

use Core\ValidationException;
use Core\Validator;

class BaseForm
{
    protected array $errors;
    public function __construct(protected array $fields)
    {
        $this->errors = [];

        foreach ($fields as $field => $value) {
            if (!Validator::string($value)) {
                $this->errors[$field] = ["$field is required"];
            }
        }
    }

    public static function validate(array $fields): ValidationException|array
    {
        $instance = new static($fields);

        return $instance->isFailed() ? $instance->throw() : $fields;
    }

    protected function isFailed(): bool
    {
        return !empty($this->errors);
    }

    public function throw(): ValidationException
    {
        return ValidationException::throw($this->errors, $this->fields);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($field, $message): static
    {
        $this->errors[$field][] = $message;

        return $this;
    }
}