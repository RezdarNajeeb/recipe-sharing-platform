<?php

namespace App\Http\Controllers;

use App\Http\Forms\LoginForm;
use App\Http\Forms\RegisterForm;
use App\Models\User;
use Core\Authenticator;
use Core\Router;
use Core\Session;

class AuthController
{
    public function register(): void
    {
        view('auth/register');
    }

    public function store(): void
    {
        $form = RegisterForm::validate($_REQUEST);

        $form->fields['password'] = password_hash($form->fields['password'], PASSWORD_BCRYPT);

        if (!User::create($form->fields)) {
            $form->error('email', 'Unknown error occurred, please try again')->throw();
        }

        Session::put('user', [
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'role' => 'user'
        ]);

        redirect('/');
    }

    public function logout(): void
    {
        Authenticator::logout();

        redirect('/login');
    }

    public function login(): void
    {
        view('auth/login');
    }

    public function authenticate(): void
    {
        $form = LoginForm::validate($_REQUEST);

        if (!Authenticator::attempt($form->fields['email'], $form->fields['password'])) {
            $form->error('email', 'Invalid Credentials')->throw();
        }

        redirect('/');
    }
}