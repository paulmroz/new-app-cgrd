<?php

declare(strict_types=1);

namespace Core;

class Validator
{
    public static function required($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }
}