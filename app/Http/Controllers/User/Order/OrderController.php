<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Orders\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('users.orders.index', [
            'orders' => Order::allByUser()->paginate(10),
        ]);
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('users.orders.show', [
            'order' => $order->load([
                'address', 'state', 'shipping', 'user',
                'order_items.product_option.color', 
                'order_items.product_option.material', 
                'order_items.product_option.sizes',
                'order_items.product_option.product',
            ]),
        ]);
    }
}
