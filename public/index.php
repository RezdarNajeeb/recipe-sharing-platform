<?php

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'vendor/autoload.php';

require BASE_PATH.'Core/functions.php';

use Core\Router;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$router = new Router();

require basePath('routes.php');

$router->route($url, $_SERVER['REQUEST_METHOD']);

