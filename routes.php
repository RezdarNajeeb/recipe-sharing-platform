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

$router->group(['middleware' => ['guest']], function () use ($router) {
    $router->get('/register', [AuthController::class => 'register']);
    $router->post('/register', [AuthController::class => 'store']);
    $router->get('/login', [AuthController::class => 'login']);
    $router->post('/login', [AuthController::class => 'authenticate']);
});

$router->delete('/logout', [AuthController::class => 'logout'])->auth();