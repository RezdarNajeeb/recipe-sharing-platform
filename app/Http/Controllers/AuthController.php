<?php

namespace App\Http\Controllers;

class AuthController
{
    public function register(): void
    {
        view('auth/register');
    }
}