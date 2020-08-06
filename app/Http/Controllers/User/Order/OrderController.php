<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;

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
            'order' => $order->load(['order_items', 'address', 'state']),
        ]);
    }
}
