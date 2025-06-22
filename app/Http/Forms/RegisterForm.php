<?php

namespace App\Http\Forms;

use Core\Validator;

class RegisterForm extends BaseForm
{
    public function __construct(array $fields)
    {
        parent::__construct($fields);

        if (!Validator::email($fields['email'])) {
            $this->error('email', 'Invalid email address');
        }

        if (!Validator::password($fields['password'])) {
            $this->error('password', 'Password should at least 8 characters and at least contains one uppercase letter, one lowercase letter, one digit, and one special characters (e.g., @, $, etc...)');
        }
    }
}