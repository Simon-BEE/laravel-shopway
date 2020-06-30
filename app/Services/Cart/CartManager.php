<?php

namespace App\Services\Cart;

use App\Models\Reference;

class CartManager
{
    public function add(Reference $productReference)
    {
        CartAdding::add($productReference);
    }

    public function remove(int $referenceId)
    {
        CartRemoving::remove($referenceId);
    }

    public function update($referenceId, $qty)
    {
        CartUpdating::update($referenceId, $qty);
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
        if (isset(session('cart')[$productId])) {
            return session('cart')[$productId]['quantity'] * session('cart')[$productId]['price'];
        }

        return 0;
    }

    public function totalItemWithTax(int $productId)
    {
        return $this->totalItemWithoutTax($productId) + ($this->totalItemWithoutTax($productId) * config('cart.tax'));
    }
}
