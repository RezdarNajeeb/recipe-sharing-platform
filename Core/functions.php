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
    return Session::get('old')[$field] ?? $default;
}

function errors(string $field): false|string
{
    return Session::get('errors')[$field][0] ?? false;
}

function user(string $field, ?string $default): string
{
    $value = Session::get('user', $default);

    if (is_array($value)) {
        $value = $value[$field];
    }

    return $value;
}

function isAuth(): bool
{
    return (bool) Session::get('user');
}

function image(string $path): string
{
    return !empty($path) ? "/image/" . urlencode($path) : "/image/cover_placeholder.jpg";
}

function pdf(string $path): string
{
    return "/file/" . urlencode($path);
}