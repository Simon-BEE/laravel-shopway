<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\Orders\Order;
use App\Models\Orders\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Models\Products\ProductOption;
use App\Repository\OrderProcessRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PushMissingOrderItemsFromCart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(OrderProcessRepository $orderProcessRepository)
    {
        $cartNeedToPush = Cart::missingOrderItems()->get();

        if ($cartNeedToPush->isEmpty()) {
            return;
        }

        $cartWithUnserializedData = $cartNeedToPush->map(function ($cart){
            return ['order_' . $cart->order_id => [$cart->order_id => $cart->content]];
        })->collapse();
        
        $orderItems = $cartWithUnserializedData->map(function ($order, $orderId) use($orderProcessRepository) {
            $orderModel = Order::findOrFail((int)Str::after($orderId, '_'));
            $o = collect(collect($order)->first());

            return $orderProcessRepository->prepareOrderItems($orderModel, $o);
        });
        
        $orderItems->each(function ($order){
            OrderItem::insert($order);
        });
    }
}
