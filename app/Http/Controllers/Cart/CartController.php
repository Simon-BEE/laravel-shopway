<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartManager;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(CartManager $cartManager)
    {
        // $cartManager->total();
        return view('cart.index');
    }
}
