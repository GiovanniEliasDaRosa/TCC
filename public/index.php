<?php

session_start();

const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
  $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
  require base_path("{$class}.php");
});

require base_path('bootstrap.php');

$router = new \Core\Router();

$routes = require base_path('routes.php');

// Use _method if we have, for custom methods like PUT, DELETE | and if we don't have just get the SERVER method (GET/POST)
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
