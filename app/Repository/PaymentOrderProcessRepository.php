<?php

namespace App\Repository;

use App\Helpers\Cart;
use App\Models\Order;
use App\Models\State;
use App\Models\OrderItem;
use App\Services\Cart\CartCalculator;

class PaymentOrderProcessRepository
{
    public function storeOrder(string $paymentIntentId , string $paymentMethod = 'card')
    {
        return Order::create([
            'state_id' => State::getStateIdBySlug($paymentMethod),
            'user_id' => auth()->id(),
            'address_id' => auth()->user()->address->id,
            'reference' => $paymentIntentId,
            'total' => app(CartCalculator::class)->totalWithTax(),
            'shipping' => 7.25,
            'payment' => $paymentMethod
        ]);
    }

    public function storeOrderItems(Order $order)
    {
        $orderItems = collect(Cart::content())->map(function ($item, $itemId) use ($order){
            return [
                'product_id' => $itemId,
                'order_id' => $order->id,
                'name' => $item['name'],
                'tax' => config('cart.tax'),
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ];
        })->toArray();

        OrderItem::insert($orderItems);
    }

    public function storePayments(Order $order)
    {
        $order->payment()->create([
            'user_id' => auth()->id(),
            'payment_id' => $order->reference,
        ]);
    }
}