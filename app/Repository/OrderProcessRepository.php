<?php

namespace App\Repository;

use App\Helpers\Cart;
use App\Models\Order;
use App\Models\State;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\Cart\CartCalculator;

class OrderProcessRepository
{
    public function storeOrder(string $state = 'paid')
    {
        return Order::create([
            'state_id' => State::getStateIdBySlug($state),
            'user_id' => auth()->id(),
            'address_id' => auth()->user()->address->id,
            'shipping_id' => Cart::shipping()->id,
            'price' => app(CartCalculator::class)->totalWithTax(),
        ]);
    }

    public function storeOrderItems(Order $order)
    {
        $orderItems = Cart::content()->map(function ($item, $itemId) use ($order){
            $product = Product::findOrFail($itemId);
            $product->update([
                'quantity' => $product->quantity - $item['quantity'],
            ]);

            return [
                'product_id' => $itemId,
                'order_id' => $order->id,
                'name' => $item['name'],
                'tax' => config('cart.tax'),
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ];
        })->toArray();

        OrderItem::insert($orderItems);
    }

    public function storePayments(Order $order, string $paymentIntentId, string $type = Payment::STRIPE_TYPE)
    {
        $order->payment()->create([
            'user_id' => auth()->id(),
            'payment_id' => $paymentIntentId,
            'type' => $type,
        ]);
    }
}
