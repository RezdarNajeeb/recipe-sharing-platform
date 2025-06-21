<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

App::setContainer($container);

App::bind(Database::class, function () {
    return new Database()->db;
});