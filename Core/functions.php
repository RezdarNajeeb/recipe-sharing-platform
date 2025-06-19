<?php

function basePath(string $path): string
{
    return __DIR__."/../$path";
}

function dd($value): void
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';

    die();
}

function abort(int $status = 404): string
{
    http_response_code(404);

    return view("errors/$status");
}

function urlIs(string $url): bool
{
    return $_SERVER['REQUEST_URI'] === $url;
}

function view(string $path, array $attributes = []): string
{
    extract($attributes);
    require basePath('resources/views/').$path.'.view.php';
}