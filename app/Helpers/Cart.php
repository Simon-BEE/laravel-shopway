<?php

namespace App\Helpers;

use App\Models\Product;
use App\Services\Cart\CartAdding;
use App\Services\Cart\CartManager;
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
