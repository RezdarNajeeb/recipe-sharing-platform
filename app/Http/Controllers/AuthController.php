<?php

namespace App\Http\Controllers;

use App\Http\Forms\RegisterForm;
use App\Models\User;
use Core\Router;
use Core\Session;

class AuthController
{
    public function register(): void
    {
        view('auth/register');
    }

    public function store()
    {
        if (!User::create(RegisterForm::validate($_REQUEST))) {
            Session::flash('errors', [
                'email' => 'Unknown error occurred, please try again'
            ]);

            redirect(Router::previousUrl());
        }

        Session::put('user', [
            'name' => $_REQUEST['name'],
            'email' => $_REQUEST['email'],
            'role' => 'user'
        ]);

        redirect('/');
    }
}