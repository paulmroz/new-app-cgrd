<?php

declare(strict_types=1);

use Core\App;
use Core\Validator;
use Core\Database;
use Core\Session;

$db = App::resolve(Database::class);

$errors = [];

if (! Validator::required($_POST['body'], 1, 1000)) 
{
    $errors['body'] = 'A body of between 1-1,000 characters is required.';
}

if (! Validator::required($_POST['title'], 1, 1000)) 
{
    $errors['title'] = 'A title of between 1-1,000 characters is required.';
}

$articleNews = $db->query('select * from news where user_id = 1')->get();


if (count($errors)) 
{
    return view("news/index.view.php", [
        'errors' => $errors,
        'articleNews' => $articleNews,
    ]);
}

if($_POST['body'] && $_POST['title']) 
{
    $db->query('INSERT INTO news(body, user_id, title) VALUES(:body, :user_id, :title)', [
        'body' => $_POST['body'],
        'user_id' => 1,
        'title' => $_POST['title'],
    ]);
}

Session::put('info', 'Row Added');

header('location: /news');
die();
