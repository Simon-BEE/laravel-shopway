<?php

namespace App\Helpers;

use Carbon\Carbon;

class Format
{
    public static function price(float $price)
    {
        return number_format(($price / 100 ), 2, '.', ' ');
    }

    public static function priceWithCurrency(float $price)
    {
        return number_format(($price / 100 ), 2, '.', ' ') . config('cart.currency');
    }

    public static function priceWithTaxAndCurrency(float $price)
    {
        return number_format((($price / 100 ) + (($price / 100 ) * config('cart.tax'))), 2, '.', ' ') . config('cart.currency');
    }

    public static function date($date, string $format = 'd/m/Y')
    {
        return Carbon::parse($date)->format($format);
    }
}
