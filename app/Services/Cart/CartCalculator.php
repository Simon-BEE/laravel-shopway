<?php

namespace App\Services\Cart;

class CartCalculator
{
    /**
     * ? TOTAL
     */

    public function totalWithoutTax()
    {
        return collect(session('cart'))->sum(function ($product){
            return collect($product)->sum(function ($size){
                return ($size['quantity'] * $size['price']);
            });
        });
    }

    public function totalWithTax()
    {
        return round($this->totalWithoutTax() + $this->totalTax());
    }

    public function totalTax()
    {
        return $this->totalWithoutTax() * config('cart.tax');
    }

    public function totalItemWithoutTax(int $productId, int $sizeId)
    {
        if (isset(session('cart')[$productId][$sizeId])) {
            return session('cart')[$productId][$sizeId]['quantity'] * session('cart')[$productId][$sizeId]['price'];
        }

        return 0;
    }

    public function totalItemWithTax(int $productId, int $sizeId)
    {
        return $this->totalItemWithoutTax($productId, $sizeId) + ($this->totalItemWithoutTax($productId, $sizeId) * config('cart.tax'));
    }
}
