<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use App\Services\Cart\CartManager;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(CartManager $cartManager, Reference $reference)
    {
        # code...
    }
}
