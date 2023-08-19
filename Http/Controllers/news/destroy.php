<?php

declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Session; 
$db = App::resolve(Database::class);

$currentUserId = 1;

$news = $db->query('select * from news where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

authorize($news['user_id'] === $currentUserId);


$db->query('delete from news where id = :id', [
    'id' => $_POST['id']
]);

$info = [];

Session::put('info', 'Row Deleted');

header('location: /news');
exit();
