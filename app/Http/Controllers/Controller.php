<?php

namespace App\Http\Controllers;

class Controller
{
    public function index(): void
    {
        view('index', [
            'heading' => 'Home'
        ]);
    }
}