<?php

namespace App\Listeners;

use App\Helpers\Cart;
use App\Events\UserIsLogout;
use App\Models\Cart as CartModel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetUserCartToDatabase implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserIsLogout  $event
     * @return void
     */
    public function handle(UserIsLogout $event)
    {
        $cart = Cart::content();

        if ($cart->isEmpty()) {
            return;
        }
        
        
        if (!$event->user->has_already_cart) {
            CartModel::create([
                'user_id' => $event->user->id,
                'content' => serialize($cart),
            ]);

            return;
        }
        
        $oldCart = $event->user->cart;
        $cart->union($oldCart->content);

        $oldCart->update([
            'content' => serialize($cart),
        ]);

        return;
    }
}
