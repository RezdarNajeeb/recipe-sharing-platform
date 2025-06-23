<?php

namespace Core\Middleware;

use Core\Session;

class Guest implements MiddlewareContract
{
    public function handle(): void
    {
        if (Session::has('user')) {
            redirect('/');
        }
    }
}