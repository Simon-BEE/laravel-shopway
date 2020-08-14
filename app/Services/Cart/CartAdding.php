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
    public static function add(Model $productOption, int $sizeId)
    {
        $cartSession = session('cart');

        if (is_null($cartSession)) {
            $cart = [$productOption->id => [$sizeId => [
                'product' => $productOption->product->id,
                'name' => isset($productOption->product->name) ? $productOption->product->name : null,
                'quantity' => 1,
                'price' => $productOption->price,
                'photo' => $productOption->mainImagePath,
                'path' => $productOption->product->path,
            ]]];

            session()->put('cart', $cart);

            return;
        }

        if (isset($cartSession[$productOption->id][$sizeId])) {
            $cartSession[$productOption->id][$sizeId]['quantity']++;
            session(['cart' => $cartSession]);

            return;
        }

        $cartSession[$productOption->id][$sizeId] = [
            'product' => $productOption->product->id,
            'name' => isset($productOption->product->name) ? $productOption->product->name : null,
            'quantity' => 1,
            'price' => $productOption->price,
            'photo' => $productOption->mainImagePath,
            'path' => $productOption->product->path,
        ];

        session()->put('cart', $cartSession);

        return;
    }
}
