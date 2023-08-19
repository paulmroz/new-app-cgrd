<?php

declare(strict_types=1);

use Core\Session;
use Core\ValidationException;
use Core\Router;

session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ .'/Core/functions.php';
require_once __DIR__ . '/bootstrap.php';

$router = new Router();

require_once __DIR__ .'/routes.php';
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();


