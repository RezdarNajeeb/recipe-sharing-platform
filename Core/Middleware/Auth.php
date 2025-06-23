<?php

namespace Core\Middleware;

use Core\Session;

class Auth implements MiddlewareContract
{
    public function handle(): void
    {
        if (!Session::has('user')) {
            redirect('/');
        }
    }
}