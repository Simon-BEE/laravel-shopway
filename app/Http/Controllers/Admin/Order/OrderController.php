<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Orders\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        auth()->user()->unreadNotifications->each(function ($notification){
            if($notification->type === 'App\Notifications\NewOrderNotification'){
                $notification->markAsRead();
            }
        });

        return view('admin.orders.index');
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', [
            'order' => $order->load([
                'address', 'state', 'shipping',
                'order_items.product_option.color', 
                'order_items.product_option.material', 
                'order_items.product_option.sizes',
                'order_items.product_option.product',
            ]),
        ]);
    }
}
