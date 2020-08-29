<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use App\Helpers\{Cart, Format};
use App\Traits\Livewire\HasFlashMessage;

class Index extends Component
{
    use HasFlashMessage;

    public function removeFromCart(int $productId, int $sizeId)
    {
        Cart::remove($productId, $sizeId);

        $this->newFlashMessage('Product successfully removed from cart.');

        $this->emit('cartUpdated');
    }

    public function redirectIfCartEmpty()
    {
        if (Cart::content()->isEmpty()) {
            return redirect()->route('products.index');
        }
    }

    public function render()
    {
        Cart::verifyProductsQuantities();

        $this->redirectIfCartEmpty();

        $shippingFees = Cart::shippingPrice();

        return view('livewire.checkout.index', [
            'cartProducts' => Cart::content(),
            'shippingFees' => Format::priceWithCurrency($shippingFees),
            'totalWithTaxAndShipping' => Format::priceWithCurrency(Cart::totalWithTaxRaw() + $shippingFees),
        ]);
    }
}
