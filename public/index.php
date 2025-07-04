<?php

session_start();

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'vendor/autoload.php';

require BASE_PATH.'Core/functions.php';

use Core\ExceptionHandler;
use Core\FileService;
use Core\Router;
use Core\Session;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

require basePath('bootstrap.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

FileService::serve($url);

$router = new Router();

require basePath('routes.php');

try {
    $router->route($url, $method);
} catch (ExceptionHandler $e) {
    Session::flash('errors', $e->errors);
    Session::flash('old', $e->old);

    redirect($router->previousUrl());
}

Session::unFlashAll();