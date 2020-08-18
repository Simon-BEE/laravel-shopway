<?php

namespace App\Jobs;

use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Models\Products\ProductOption;
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
    public function handle()
    {
        $cartNeedToPush = Cart::missingOrderItems()->get();

        if ($cartNeedToPush->isEmpty()) {
            return;
        }

        $cartWithUnserializedData = $cartNeedToPush->map(function ($cart, $cartKey){
            return ['order_' . $cart->order_id => [$cart->order_id => $cart->content]];
        })->collapse();
        
        $orderItems = $cartWithUnserializedData->map(function ($order, $orderId) {
            $orderId = (int)Str::after($orderId, '_');
            $o = collect(collect($order)->first());
            return $o->map(function ($productOptions, $productOptionId) use ($orderId){
                return collect($productOptions)->map(function ($optionItem, $optionItemSizeId) use ($orderId, $productOptionId){
                    $product = ProductItemOption::findOrFail($productOptionId);
                    $product->update([
                        'quantity' => $product->quantity - $optionItem['quantity'],
                    ]);
    
                    return [
                        'product_option_id' => $productOptionId,
                        'order_id' => $orderId,
                        'size_id' => $optionItemSizeId,
                        'name' => $optionItem['name'],
                        'tax' => config('cart.tax'),
                        'price' => $optionItem['price'],
                        'quantity' => $optionItem['quantity'],
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                });
            })->collapse()->toArray();
        });
        
        $orderItems->each(function ($order){
            OrderItem::insert($order);
        });
    }
}
