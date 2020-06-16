<?php

namespace App\Services\Cart;

use App\Models\Reference;

class CartManager
{
    public function add(Reference $productReference)
    {
        Adding::add($productReference);
    }

    // public function update(Request $request)
    // {
    //     if($request->id and $request->quantity)
    //     {
    //         $cart = session()->get('cart');

    //         $cart[$request->id]["quantity"] = $request->quantity;

    //         session()->put('cart', $cart);

    //         session()->flash('success', 'Cart updated successfully');
    //     }
    // }

    // public function remove(Request $request)
    // {
    //     if($request->id) {

    //         $cart = session()->get('cart');

    //         if(isset($cart[$request->id])) {

    //             unset($cart[$request->id]);

    //             session()->put('cart', $cart);
    //         }

    //         session()->flash('success', 'Product removed successfully');
    //     }
    // }
}
