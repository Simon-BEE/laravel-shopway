<?php

namespace App\Listeners;

use App\Events\UserIsLogout;
use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        if (!$cart = session('cart')) {
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

        Cart::create([
            'user_id' => $event->user->id,
            'content' => serialize($cart),
        ]);
    }
}
