<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Controller;

$router->get('/', [Controller::class => 'index']);

$router->get('/books', [BookController::class => 'index'])->auth();
$router->get('/books/create', [BookController::class => 'create']);
$router->post('/books', [BookController::class => 'store']);
$router->get('/books/edit', [BookController::class => 'edit']);
$router->put('/books', [BookController::class => 'update']);
$router->delete('/books', [BookController::class => 'destroy']);
$router->get("/book", [BookController::class => 'show']);

$router->get('/register', [AuthController::class => 'register'])->guest();
$router->post('/register', [AuthController::class => 'store'])->guest();
$router->delete('/logout', [AuthController::class => 'logout'])->auth();
$router->get('/login', [AuthController::class => 'login'])->guest();
$router->post('/login', [AuthController::class => 'authenticate'])->guest();