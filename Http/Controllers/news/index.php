<?php

declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);
$articleNews = $db->query('select * from news where user_id = 1')->get();

$info = Session::has('info') ? Session::get('info') : null;

Session::remove('info');

view("news/index.view.php", [
    'articleNews' => $articleNews,
    'info' => $info
]);