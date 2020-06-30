<?php

namespace App\Helpers;

use Carbon\Carbon;

class Format
{
    public static function price(float $price)
    {
        return number_format($price, 2, '.', ' ');
    }

    public static function priceWithCurrency(float $price)
    {
        return number_format($price, 2, '.', ' ') . config('cart.currency');
    }

    public static function priceWithTaxAndCurrency(float $price)
    {
        return number_format(($price + ($price * config('cart.tax'))), 2, '.', ' ') . config('cart.currency');
    }

    public static function date($date, string $format = 'd/m/Y')
    {
        return Carbon::parse($date)->format($format);
    }
}
