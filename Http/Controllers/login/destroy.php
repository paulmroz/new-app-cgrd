<?php

declare(strict_types=1);

(new Core\Authenticator)->logout();

header('location: /');
exit();