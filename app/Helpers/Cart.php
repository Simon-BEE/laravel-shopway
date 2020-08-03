<?php

namespace App\Helpers;

use App\Models\Product;
use App\Services\Cart\CartAdding;
use App\Services\Cart\CartCalculator;
use App\Services\Cart\CartRemoving;
use App\Services\Cart\CartUpdating;

class Cart
{
    /**
     * ? Get Result of session
     */

    public static function content()
    {
        return session('cart');
    }

    public static function item(int $itemId)
    {
        return session('cart')[$itemId];
    }

    /**
     * ? Do actions on cart
     */

    public static function clear()
    {
        return session()->forget(['cart']);
    }

    public static function remove(int $itemId)
    {
        CartRemoving::remove($itemId);
    }

    public static function add(Product $product)
    {
        CartAdding::add($product);
    }

    public static function update(int $productId, int $qty)
    {
        CartUpdating::update($productId, $qty);
    }

    /**
     * ? Get amount results
     */

    public static function totalWithoutTax()
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalWithoutTax()) . config('cart.currency');
    }

    public static function totalWithTax()
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalWithTax()) . config('cart.currency');
    }

    public static function totalItemWithoutTax(int $productId)
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalItemWithoutTax($productId)) . config('cart.currency');
    }

    public static function totalItemWithTax(int $productId)
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalItemWithTax($productId)) . config('cart.currency');
    }

    public static function totalTax()
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalTax()) . config('cart.currency');
    }
}
