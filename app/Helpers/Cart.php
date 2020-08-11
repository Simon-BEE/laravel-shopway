<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\ProductItemOption;
use App\Models\Shipping;
use App\Services\Cart\CartAdding;
use App\Services\Cart\CartCalculator;
use App\Services\Cart\CartRemoving;
use App\Services\Cart\CartUpdating;

class Cart
{
    /**
     * ? Get Result of session
     */

    public static function content()
    {
        return session('cart');
    }

    public static function item(int $itemId)
    {
        return session('cart')[$itemId];
    }

    public static function shipping(): Shipping
    {
        $totalWeight = collect(self::content())->map(function ($item, $itemId){
            $product = self::model($itemId);
            return $item['quantity'] * $product->weight;
        })->sum();

        $shipping = Shipping::byWeight($totalWeight, 1)->first();

        return $shipping;
    }

    public static function shippingPrice(): int
    {
        return self::shipping()->price;
    }

    public static function model(int $itemId)
    {
        return Product::select('weight')->where('id', $itemId)->firstOrFail();
    }

    /**
     * ? Do actions on cart
     */

    public static function clear()
    {
        return session()->forget(['cart']);
    }

    public static function remove(int $itemId, int $sizeId)
    {
        CartRemoving::remove($itemId, $sizeId);
    }

    public static function add(ProductItemOption $product, int $sizeId)
    {
        CartAdding::add($product, $sizeId);
    }

    public static function update(int $productId, int $sizeId, int $qty)
    {
        CartUpdating::update($productId, $sizeId, $qty);
    }

    /**
     * ? Get amount results
     */

    public static function shippingFees()
    {
        return Format::price(self::shippingPrice()) . config('cart.currency');
    }

    public static function totalWithoutTax()
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalWithoutTax()) . config('cart.currency');
    }

    public static function totalWithTax()
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalWithTax()) . config('cart.currency');
    }

    public static function totalWithoutTaxRaw()
    {
        $calculator = new CartCalculator();
        return $calculator->totalWithoutTax();
    }

    public static function totalWithTaxRaw()
    {
        $calculator = new CartCalculator();
        return $calculator->totalWithTax();
    }

    public static function totalWithTaxAndShipping()
    {
        $calculator = new CartCalculator();
        return Format::price(($calculator->totalWithTax() + self::shippingPrice())) . config('cart.currency');
    }

    public static function totalItemWithoutTax(int $productId)
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalItemWithoutTax($productId)) . config('cart.currency');
    }

    public static function totalItemWithTax(int $productId)
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalItemWithTax($productId)) . config('cart.currency');
    }

    public static function totalTax()
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalTax()) . config('cart.currency');
    }
}
