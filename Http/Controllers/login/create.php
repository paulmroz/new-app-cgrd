<?php

declare(strict_types=1);

use Core\Session;

view('login/create.view.php', [
    'errors' => Session::get('errors')
]);
