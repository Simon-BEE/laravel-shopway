<?php

namespace App\Services\Cart;

use Illuminate\Database\Eloquent\Model;

class CartAdding
{
    /**
     * Add a product in cart
     *
     * @param Model $product
     * @return void
     */
    public static function add(Model $product)
    {
        $cartSession = session('cart');

        if (is_null($cartSession)) {
            $cart = [
                $product->id => [
                    'name' => isset($product->name) ? $product->name : null,
                    'quantity' => 1,
                    'price' => $product->price,
                    'photo' => $product->mainImagePath
                ]
            ];

            session()->put('cart', $cart);

            return;
        }

        if (isset($cartSession[$product->id])) {
            $cartSession[$product->id]['quantity']++;
            session(['cart' => $cartSession]);

            return;
        }

        $cartSession[$product->id] = [
            'name' => isset($product->name) ? $product->name : null,
            'quantity' => 1,
            'price' => $product->price,
            'photo' => $product->mainImagePath
        ];

        session()->put('cart', $cartSession);

        return;
    }
}
