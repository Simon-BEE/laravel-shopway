<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\{Cart, Format};
use App\Models\Products\ProductOption;
use App\Models\Products\Size;

class Index extends Component
{
    public function removeFromCart(int $productId, int $sizeId)
    {
        Cart::remove($productId, $sizeId);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully removed from cart.',
            'id' => Str::random(10)
        ]);

        $this->emit('cartUpdated');
    }

    public function redirectIfCartEmpty()
    {
        if (Cart::content()->isEmpty()) {
            return redirect()->route('products.index');
        }
    }

    public function checkProductsQuantities()
    {
        Cart::content()->each(function ($cartItem, $productOptionKey){
            collect($cartItem)->each(function ($itemContent, $sizeOptionId) use ($productOptionKey){

                $optionSizeQuantityInStock = ProductOption::find($productOptionKey)->whereSizeIs($sizeOptionId)->pivot->quantity;

                if (($optionSizeQuantityInStock - $itemContent['quantity']) <= Size::QUANTITY_ALERT) {
                    Cart::update($productOptionKey, $sizeOptionId, (int)$itemContent['quantity'] - 1);

                    $this->checkProductsQuantities();
                }
            });
        });
    }

    public function render()
    {
        $this->checkProductsQuantities();

        $this->redirectIfCartEmpty();

        $shippingFees = Cart::shippingPrice();

        return view('livewire.checkout.index', [
            'cartProducts' => Cart::content(),
            'shippingFees' => Format::priceWithCurrency($shippingFees),
            'totalWithTaxAndShipping' => Format::priceWithCurrency(Cart::totalWithTaxRaw() + $shippingFees),
        ]);
    }
}
