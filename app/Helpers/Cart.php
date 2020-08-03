<?php

namespace App\Helpers;

use App\Services\Cart\CartManager;

class Cart
{
    public static function content()
    {
        return session('cart');
    }

    public static function clear()
    {
        return session()->forget(['cart']);
    }

    public static function totalWithoutTax()
    {
        $cartManager = new CartManager();
        return Format::price($cartManager->totalWithoutTax()) . config('cart.currency');
    }

    public static function totalWithTax()
    {
        $cartManager = new CartManager();
        return Format::price($cartManager->totalWithTax()) . config('cart.currency');
    }

    public static function totalItemWithoutTax(int $productId)
    {
        $cartManager = new CartManager();
        return Format::price($cartManager->totalItemWithoutTax($productId)) . config('cart.currency');
    }

    public static function totalItemWithTax(int $productId)
    {
        $cartManager = new CartManager();
        return Format::price($cartManager->totalItemWithTax($productId)) . config('cart.currency');
    }

    public static function totalTax()
    {
        $cartManager = new CartManager();
        return Format::price($cartManager->totalTax()) . config('cart.currency');
    }
}
