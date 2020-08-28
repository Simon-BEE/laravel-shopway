<?php

namespace App\Helpers;

use App\Models\Products\ProductOption;
use App\Models\Orders\Shipping;
use App\Models\Products\Size;
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
        $totalWeight = self::content()->map(function ($cartProductOption, $optionId){
            return collect($cartProductOption)->map(function ($cartItem, $sizeId) use ($optionId){
                $productOption = self::model($optionId);
                return $cartItem['quantity'] * $productOption->weight;
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
        return ProductOption::select(['weight'])->findOrFail($itemId);
    }

    public static function count(): int
    {
        return Cart::content()->map(function ($c){
            return count($c);
        })->sum();
    }

    public static function size(int $sizeId): ?string
    {
        return Size::findOrFail($sizeId)->name;
    }

    /**
     * ? Do actions on cart
     */

    public static function clear()
    {
        return session()->forget(['cart']);
    }

    public static function remove(int $productOptionId, int $sizeId): void
    {
        CartRemoving::remove($productOptionId, $sizeId);
    }

    public static function add(ProductOption $productOption, int $sizeId): void
    {
        CartAdding::add($productOption, $sizeId);
    }

    public static function update(int $productOptionId, int $sizeId, int $qty): void
    {
        CartUpdating::update($productOptionId, $sizeId, $qty);
    }

    public static function verifyProductsQuantities(): void
    {
        self::content()->each(function ($cartItem, $productOptionKey){
            collect($cartItem)->each(function ($itemContent, $sizeOptionId) use ($productOptionKey){

                $optionSizeQuantityInStock = ProductOption::find($productOptionKey)->whereSizeIs($sizeOptionId)->pivot->quantity;

                if (($optionSizeQuantityInStock - $itemContent['quantity']) < Size::QUANTITY_ALERT) {
                    // dd($optionSizeQuantityInStock, $itemContent, ($optionSizeQuantityInStock - $itemContent['quantity']));
                    self::update($productOptionKey, $sizeOptionId, (int)$itemContent['quantity'] - 1);


                    self::verifyProductsQuantities();
                }

                if ($itemContent['quantity'] === 0) {
                    self::remove($productOptionKey, $sizeOptionId);
                }
            });
        });
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
