<?php

declare(strict_types=1);

$router->get('/', 'news/index.php')->only('auth');


$router->get('/news', 'news/index.php')->only('auth');
$router->delete('/news', 'news/destroy.php');
$router->patch('/news', 'news/update.php');
$router->post('/news', 'news/store.php');

$router->get('/login', 'login/create.php')->only('guest');
$router->post('/session', 'login/store.php')->only('guest');
$router->delete('/session', 'login/destroy.php')->only('auth');


