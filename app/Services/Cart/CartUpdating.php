<?php

namespace App\Services\Cart;

class CartUpdating
{
    /**
     * Update a product in cart by its reference id
     *
     * @param int $productId
     * @return void
     */
    public static function update(int $productId, int $qty)
    {
        $cart = session('cart');

        if(isset($cart[$productId])){

            $cart[$productId]["quantity"] = $qty;

            session()->put('cart', $cart);
        }
    }
}
