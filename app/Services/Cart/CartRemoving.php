<?php

namespace App\Services\Cart;

class CartRemoving
{
    /**
     * Remove a product in cart
     *
     * @param int $productId
     * @param int $sizeId
     * @return void
     */
    public static function remove(int $productId, int $sizeId)
    {
        $cart = session('cart');

        if(isset($cart[$productId][$sizeId])) {

            unset($cart[$productId][$sizeId]);

            session()->put('cart', $cart);
        }
    }
}
