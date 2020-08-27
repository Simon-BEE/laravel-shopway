<?php

namespace App\Listeners;

use App\Models\Users\User;
use App\Mail\ConfirmOrderMail;
use App\Models\Orders\Order;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewOrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewOrderNotifications implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = Order::lastOrderByUser($event->user->id);

        Mail::to($event->user)->queue(new ConfirmOrderMail($event->user, $order));

        User::admins()->each(function ($admin) use ($order){
            $admin->notify(new NewOrderNotification($order));
        });
    }
}
