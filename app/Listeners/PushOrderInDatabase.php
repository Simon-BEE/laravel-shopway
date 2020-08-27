<?php

namespace App\Listeners;

use App\Events\OrderPerformed;
use App\Models\Orders\Order;
use App\Models\Orders\Payment;
use Illuminate\Queue\InteractsWithQueue;
use App\Repository\OrderProcessRepository;
use App\Jobs\PushMissingOrderItemsFromCart;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Cart as CartModel;
use Illuminate\Queue\SerializesModels;

class PushOrderInDatabase
{

    public $orderProcessRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OrderProcessRepository $orderProcessRepository)
    {
        $this->orderProcessRepository = $orderProcessRepository;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderPerformed $event)
    {
        $order = $this->orderProcessRepository->storeOrder($event->state);

        try {
            $this->orderProcessRepository->storePayments($order, request()->paymentIntent, Payment::STRIPE_TYPE);
            $this->orderProcessRepository->storeOrderItems($order);
    
        } catch (\Exception $e) {
            $this->saveCartInDatabase($order);

            PushMissingOrderItemsFromCart::dispatch();
        }

        session()->put('checkout_success', $order->id);
    }

    private function saveCartInDatabase(Order $order)
    {
        CartModel::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'content' => serialize(session('cart')),
        ]);
    }
}
