<?php

namespace App\Services\Cart;

use App\Models\Reference;

class CartManager
{
    public function add(Reference $productReference)
    {
        Adding::add($productReference);
    }

    public function remove(int $referenceId)
    {
        Removing::remove($referenceId);
    }

    public function update($referenceId, $qty)
    {
        Updating::update($referenceId, $qty);
    }

    /**
     * ? TOTAL
     */

    public function totalWithoutTax()
    {
        return collect(session('cart'))->sum(function ($product){
            return ($product['quantity'] * $product['price']);
        });
    }

    public function totalWithTax()
    {
        return $this->totalWithoutTax() + $this->totalTax();
    }

    public function totalTax()
    {
        return $this->totalWithoutTax() * config('cart.tax');
    }

    public function totalItemWithoutTax(int $productId)
    {
        return session('cart')[$productId]['quantity'] * session('cart')[$productId]['price'];
    }

    public function totalItemWithTax(int $productId)
    {
        return $this->totalItemWithoutTax($productId) + ($this->totalItemWithoutTax($productId) * config('cart.tax'));
    }
}
