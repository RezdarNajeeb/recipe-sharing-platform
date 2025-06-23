<?php

namespace Core\Middleware;

use Core\Session;

class Auth
{
    public function handle(): void
    {
        if (!Session::has('user')) {
            redirect('/');
        }
    }
}