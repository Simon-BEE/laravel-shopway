<?php

namespace App\Services\Cart;

class CartUpdating
{
    /**
     * Update a product in cart by its id
     *
     * @param int $productId
     * @param int $sizeId
     * @return void
     */
    public static function update(int $productId, int $sizeId, int $qty)
    {
        $cart = session('cart');

        if(isset($cart[$productId][$sizeId])){

            $cart[$productId][$sizeId]["quantity"] = $qty;

            session()->put('cart', $cart);
        }
    }
}
