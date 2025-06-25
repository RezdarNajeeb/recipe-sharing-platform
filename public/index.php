<?php

session_start();

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'vendor/autoload.php';

require BASE_PATH.'Core/functions.php';

use Core\ExceptionHandler;
use Core\Router;
use Core\Session;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

require basePath('bootstrap.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// To solve "Not allowed to load local file" problem
if (preg_match('#^/(image|file)/(.+)$#', $url, $matches)) {
    $type = $matches[1]; // image or file
    $fileName = basename($matches[2]);
    $filePath = urldecode(basePath("storage/{$type}s/$fileName"));

    if (file_exists($filePath)) {
        $mime = mime_content_type($filePath);
        header("Content-Type: $mime");
        header("Content-Length: " . filesize($filePath));
        readfile($filePath);
    } else {
        http_response_code(404);
        echo "Image not found.";
    }
    exit;
}

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