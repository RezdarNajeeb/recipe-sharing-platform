<?php

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'vendor/autoload.php';

require BASE_PATH.'Core/functions.php';

use Core\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(BASE_PATH);
$dotenv->safeLoad();

$db = new Database();

$results = $db->query('SELECT * FROM users where id=1')->findOrFail();

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/index.php',
    '/register' => 'controllers/registration/create.php'
];

if (!array_key_exists($url, $routes)) {
    abort();
}
require basePath($routes[$url]);
