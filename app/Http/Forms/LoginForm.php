<?php

namespace App\Http\Forms;

use Core\Validator;

class LoginForm extends BaseForm
{
    public function __construct(array $fields)
    {
        parent::__construct($fields);

        if (!Validator::email($fields['email'])) {
            $this->error('email', 'Invalid email address');
        }
    }
}