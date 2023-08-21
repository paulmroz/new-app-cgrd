<?php

declare(strict_types=1);

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']
);

if (!$signedIn) 
{
    $form->error(
        'account', 'Wrong Login Data'
    )->throw();
}

redirect('/');
