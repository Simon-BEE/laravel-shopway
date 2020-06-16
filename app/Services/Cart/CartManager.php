<?php

namespace App\Services\Cart;

use App\Models\Reference;

class CartManager
{
    public function add(Reference $productReference)
    {
        Adding::add($productReference);
    }
}
