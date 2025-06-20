<?php

use Core\Session;
use JetBrains\PhpStorm\NoReturn;

function basePath(string $path): string
{
    return __DIR__."/../$path";
}

#[NoReturn] function dd($value): void
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';

    die();
}

#[NoReturn] function abort(int $status = 404): void
{
    http_response_code(404);

    view("errors/$status");

    die();
}

function urlIs(string $url): bool
{
    return $_SERVER['REQUEST_URI'] === $url;
}

function view(string $path, array $attributes = []): void
{
    extract($attributes);
    require basePath('resources/views/').$path.'.view.php';
}

function redirect(string $path): void
{
    header("location: $path");
    exit();
}

function old(string $field, string $default = ''): string
{
    return Session::get('old', true)[$field] ?? $default;
}