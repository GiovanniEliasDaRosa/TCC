<?php

use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR;

require BASE_PATH . 'Core/functions.php';

require BASE_PATH . '/vendor/autoload.php';

session_start();

require base_path('bootstrap.php');

$router = new \Core\Router();

$routes = require base_path('routes.php');

$parsed = parse_url($_SERVER['REQUEST_URI']);

if ($parsed == false) {
  abort();
}

$uri = $parsed['path'];
// Use _method if we have, for custom methods like PUT, DELETE | and if we don't have just get the SERVER method (GET/POST)
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
  $router->route($uri, $method);
} catch (ValidationException $exception) {
  Session::flash('errors', $exception->errors);
  Session::flash('old', $exception->old);

  return redirect($router->previousUrl());
}


Session::unflash();
