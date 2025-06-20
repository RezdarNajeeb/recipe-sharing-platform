<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Controller;

$router->get('/', [Controller::class => 'index']);

$router->get('/books', [BookController::class => 'index']);
$router->get('/books/create', [BookController::class => 'create']);
$router->post('/books', [BookController::class => 'store']);

