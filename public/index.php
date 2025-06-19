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

if ($_SERVER['REQUEST_URI'] === '/register') {
    require basePath('resources/views/registration/create.php');
} elseif ($_SERVER['REQUEST_URI'] === '/') {
    require basePath('resources/views/index.view.php');
}