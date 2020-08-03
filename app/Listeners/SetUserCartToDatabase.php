<?php

namespace App\Listeners;

use App\Helpers\Cart;
use App\Events\UserIsLogout;
use App\Models\Cart as CartModel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetUserCartToDatabase
{
    /**
     * Handle the event.
     *
     * @param  UserIsLogout  $event
     * @return void
     */
    public function handle(UserIsLogout $event)
    {
        if (!$cart = Cart::content()) {
            if ($event->user->hasAlreadyCart) {
                $event->user->cart()->delete();
            }
            return;
        }

        if ($event->user->hasAlreadyCart) {
            $event->user->cart()->update([
                'content' => serialize($cart)
            ]);
            return;
        }

        CartModel::create([
            'user_id' => $event->user->id,
            'content' => serialize($cart),
        ]);
    }
}
