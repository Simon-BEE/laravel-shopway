<?php

namespace App\Listeners;

use App\Helpers\Cart;
use App\Events\UserIsLogged;
use App\Models\Products\ProductOption;
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

        $cart = Cart::content();
        $oldCart = $event->user->cart;
        /** @var Collection */
        $oldContent = $oldCart->content;

        if ($cart->isEmpty()) {
            $this->addItemsToCart($oldContent);

            return;
        }

        Cart::clear();
        $this->addItemsToCart($cart->union($oldContent));

        return;
    }

    /**
     * Check if product already exist and add to session cart
     *
     * @param Collection $cart
     * @return void
     */
    private function addItemsToCart(Collection $cart): void
    {
        $cart->each(function ($item, $productOptionId){
            $productOption = ProductOption::findOrFail($productOptionId);

            collect($item)->each(function ($itemContent, $sizeId) use ($productOption){

                if (Cart::exists($productOption->id, $sizeId) || $itemContent['quantity'] > 1) {
                    Cart::update($productOption->id, $sizeId, $itemContent['quantity']);
                }else{
                    Cart::add($productOption, $sizeId);
                }
            });
        });
    }
}
