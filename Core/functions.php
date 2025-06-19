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

function abort()
{

}