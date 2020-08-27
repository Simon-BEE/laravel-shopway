<?php

namespace App\Services\Cart;

class CartRemoving
{
    /**
     * Remove a product in cart
     *
     * @param int $productOptionId
     * @param int $sizeId
     * @return void
     */
    public static function remove(int $productOptionId, int $sizeId)
    {
        $cart = session('cart');

        if(isset($cart[$productOptionId][$sizeId])) {

            unset($cart[$productOptionId][$sizeId]);

            if (empty($cart[$productOptionId])) {
                unset($cart[$productOptionId]);
            }

            session()->put('cart', $cart);
        }
    }
}
