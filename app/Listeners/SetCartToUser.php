<?php

namespace App\Listeners;

use App\Events\UserIsLogged;
use App\Models\Cart;
use App\Models\Product;
use App\Services\Cart\CartManager;
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

        if (!$cartSession = session('cart')) {
            $this->addItemsToCart($cartFromDatabase);
            return;
        }

        $cart = collect($cartSession)->union($cartFromDatabase);
        $this->addItemsToCart($cart);
    }

    /**
     * Check if product already exist and add to session cart
     *
     * @param Cart $cart
     * @return void
     */
    private function addItemsToCart(Collection $cart): void
    {
        $cartManager = new CartManager();

        $cart->each(function ($item, $productId) use ($cartManager){
            if ($product = Product::find($productId)) {
                return $cartManager->add($product);
            }
        });
    }
}
