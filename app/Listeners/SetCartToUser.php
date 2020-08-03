<?php

namespace App\Listeners;

use App\Helpers\Cart;
use App\Models\Product;
use App\Events\UserIsLogged;
use Illuminate\Support\Collection;

class SetCartToUser
{
    /**
     * Handle the event.
     *
     * @param  UserIsLogged  $event
     * @return void
     */
    public function handle(UserIsLogged $event): void
    {
        if (!$event->user->hasAlreadyCart) {
            return;
        }

        $cartFromDatabase = collect($event->user->cart->content);

        if (!$cartSession = Cart::content()) {
            $this->addItemsToCart($cartFromDatabase);
            return;
        }

        $cart = collect($cartSession)->union($cartFromDatabase);
        $this->addItemsToCart($cart);
    }

    /**
     * Check if product already exist and add to session cart
     *
     * @param Collection $cart
     * @return void
     */
    private function addItemsToCart(Collection $cart): void
    {
        $cart->each(function ($item, $productId){
            if ($product = Product::find($productId)) {
                return Cart::add($product);
            }
        });
    }
}
