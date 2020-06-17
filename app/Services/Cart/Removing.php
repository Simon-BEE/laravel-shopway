<?php

namespace App\Services\Cart;

class Removing
{
    /**
     * Remove a product in cart
     *
     * @param int $productId
     * @return void
     */
    public static function remove(int $productId)
    {
        $cart = session('cart');

        if(isset($cart[$productId])) {

            unset($cart[$productId]);

            session()->put('cart', $cart);
        }
    }
}
