<?php

declare(strict_types=1);

// $password = 'test';
// $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// echo "Hashed Password: " . $hashedPassword;
// die();
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
    Session::flash('info', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();


