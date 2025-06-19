<?php
require 'vendor/autoload.php';

use Core\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$db = new Database();

$results = $db->query('SELECT * FROM users where id=3')->findOrFail();

echo '<pre>';
print_r($results);
echo '</pre>';