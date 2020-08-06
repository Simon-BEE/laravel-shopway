<?php

namespace App\Helpers;

use Carbon\Carbon;

class Format
{
    public static function priceWithCurrency(float $price)
    {
        return self::price($price) . config('cart.currency');
    }

    public static function priceWithTaxAndCurrency(float $price)
    {
        return self::priceWithTax($price) . config('cart.currency');
    }

    public static function priceWithoutTaxAndWithCurrency(float $price)
    {
        return self::priceWithoutTax($price) . config('cart.currency');
    }

    public static function price(float $price)
    {
        return number_format(($price / 100 ), 2, '.', ' ');
    }

    public static function priceWithTax(float $price)
    {
        return number_format((($price / 100 ) + (($price / 100 ) * config('cart.tax'))), 2, '.', ' ');
    }

    public static function priceWithoutTax(float $price)
    {
        return number_format(($price / ((config('cart.tax') * 100) + 100)), 2, '.', ' ');
    }

    public static function date($date, string $format = 'd/m/Y')
    {
        return Carbon::parse($date)->format($format);
    }
}
