<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Controller;

$router->get('/', [Controller::class => 'index']);

$router->get('/books', [BookController::class => 'index']);
$router->get("/book", [BookController::class => 'show']);
$router->get('/books/create', [BookController::class => 'create']);
$router->post('/books', [BookController::class => 'store']);
$router->get('/books/edit', [BookController::class => 'edit']);
$router->put('/books', [BookController::class => 'update']);
