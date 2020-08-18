<?php

namespace App\Helpers;

use App\Models\Option;
use App\Models\Products\ProductOption;
use App\Models\Orders\Shipping;
use App\Services\Cart\CartAdding;
use App\Services\Cart\CartCalculator;
use App\Services\Cart\CartRemoving;
use App\Services\Cart\CartUpdating;
use Illuminate\Support\Collection;

class Cart
{
    /**
     * ? Get Result of session
     */

    public static function content(): Collection
    {
        return collect(session('cart'));
    }

    public static function item(int $itemId): array
    {
        return session('cart')[$itemId];
    }

    public static function shipping(): Shipping
    {
        $totalWeight = self::content()->map(function ($item, $itemId){
            return collect($item)->map(function ($option, $optionId){
                $product = self::model($optionId);
                return $option['quantity'] * $product->weight;
            })->sum();
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
        return ProductItemOption::select(['weight', 'quantity'])->where('id', $itemId)->firstOrFail();
    }

    public static function count(): int
    {
        return Cart::content()->map(function ($c){
            return count($c);
        })->sum();
    }

    public static function size(int $sizeId): string
    {
        return Option::MAP_SIZES[$sizeId];
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

    public static function totalItemWithoutTax(int $productId, int $sizeId)
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalItemWithoutTax($productId, $sizeId)) . config('cart.currency');
    }

    public static function totalItemWithTax(int $productId, int $sizeId)
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalItemWithTax($productId, $sizeId)) . config('cart.currency');
    }

    public static function totalTax()
    {
        $calculator = new CartCalculator();
        return Format::price($calculator->totalTax()) . config('cart.currency');
    }
}
