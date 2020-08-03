<?php

namespace App\Services\Cart;

use App\Helpers\Cart;
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
        $cartSession = Cart::content();

        if (is_null($cartSession)) {
            $cart = [
                $product->id => [
                    'name' => isset($product->name) ? $product->name : null,
                    'quantity' => 1,
                    'price' => $product->price,
                    'photo' => $product->mainImagePath,
                    'path' => $product->path,
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
            'photo' => $product->mainImagePath,
            'path' => $product->path,
        ];

        session()->put('cart', $cartSession);

        return;
    }
}
