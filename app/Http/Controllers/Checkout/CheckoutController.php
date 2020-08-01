<?php

namespace App\Http\Controllers\Checkout;

use Stripe\Stripe;
use App\Helpers\Cart;
use App\Models\Order;
use App\Models\State;
use Stripe\PaymentIntent;
use App\Services\Cart\CartManager;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $clientSecret = PaymentIntent::create([
            'amount' => app(CartManager::class)->totalWithTax(),
            'currency' => config('cart.currency_iso'),
            'metadata' => [
                'user_id' => auth()->id(),
            ],
        ])->client_secret;

        return view('checkout.index', [
            'cartProducts' => session('cart'),
            'totalWithTax' => Cart::totalWithTax(),
            'clientSecret' => $clientSecret
        ]);
    }

    public function payment()
    {

        session()->put('pId', request()->paymentIntent);

        return response()->json([
            'success' => true,
        ]);
    }

    public function successful()
    {
        $order = $this->storeOrder(session('pId'));

        $this->storeOrderItems($order);

        $this->storePayments($order);

        Cart::clear();

        return view('checkout.success');
    }

    public function error()
    {
        return view('checkout.error');
    }

    private function storeOrder(string $paymentIntentId , string $paymentMethod = 'card')
    {
        return Order::create([
            'state_id' => State::getStateIdBySlug($paymentMethod),
            'user_id' => auth()->id(),
            'address_id' => auth()->user()->address->id,
            'reference' => $paymentIntentId,
            'total' => app(CartManager::class)->totalWithTax(),
            'shipping' => 7.25,
            'payment' => $paymentMethod
        ]);
    }

    private function storeOrderItems(Order $order)
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