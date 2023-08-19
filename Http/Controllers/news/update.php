<?php

declare(strict_types=1);

use Core\App;
use Core\Database;
use Core\Validator;
use Core\Session;
$db = App::resolve(Database::class);

$news = $db->query('select * from news where id = :id', [
    'id' => $_POST['id']
])->findOrFail();

$errors = [];

if (! Validator::required($_POST['body'], 1, 10)) {
    $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (count($errors)) {   
    return view('news/edit.view.php', [
        'errors' => $errors,
        'news' => $news
    ]);
}

$db->query('update news set body = :body, title = :title where id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body'],
    'title' => $_POST['title']
]);

Session::put('info', 'Row Changed');

header('location: /news');
die();
