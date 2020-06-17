<?php

namespace App\Helpers;

class Format
{
    public static function price(float $price)
    {
        return number_format($price, 2, '.', ' ');
    }
}
