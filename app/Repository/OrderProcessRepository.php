<?php

namespace App\Repository;

use App\Helpers\Cart;
use App\Models\Orders\Order;
use App\Models\Orders\State;
use App\Models\Orders\OrderItem;
use App\Models\Orders\Payment;
use App\Models\Products\ProductOption;
use App\Services\Cart\CartCalculator;
use Illuminate\Support\Collection;

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

    /**
     * Push in database all cart items
     * If cart is null, session cart will be take
     *
     * @param Order $order
     * @param Collection $cart
     * @return void
     */
    public function storeOrderItems(Order $order)
    {
        $orderItems = $this->prepareOrderItems($order);

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

    public function prepareOrderItems(Order $order, Collection $cart = null)
    {
        $cart = $cart ?? Cart::content();

        return $cart->map(function ($productOptions, $productOptionId) use ($order){
            return collect($productOptions)->map(function ($optionItem, $optionItemSizeId) use ($order, $productOptionId){

                $this->updateQuantity($productOptionId, $optionItemSizeId, $optionItem['quantity']);

                return [
                    'product_option_id' => $productOptionId,
                    'order_id' => $order->id,
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
    }

    public function updateQuantity(int $productOptionId, int $sizeId, int $quantity)
    {
        $sizeOption = ProductOption::find($productOptionId)->whereSizeIs($sizeId);
        
        if ($sizeOption->pivot->quantity >= $quantity) {
            $sizeOption->pivot->update([
                'quantity' => $sizeOption->pivot->quantity - $quantity,
                ]);

            $sizeOption->refresh();

            if ($sizeOption->pivot->quantity < 1) {
                $sizeOption->pivot->delete();
            }
        }else{
            throw new \Exception("Quantity can't be updated", 1);
        }
    }
}
