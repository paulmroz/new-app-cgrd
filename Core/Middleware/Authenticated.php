<?php

declare(strict_types=1);

namespace Core\Middleware;

class Authenticated
{
    public function handle()
    {
        if (! isset($_SESSION['user']) ?? false) {
            header('location: /login');
            exit();
        }
    }
}