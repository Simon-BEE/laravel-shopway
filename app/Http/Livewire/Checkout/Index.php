<?php

namespace App\Http\Livewire\Checkout;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\{Cart, Format};

class Index extends Component
{
    public function removeFromCart(int $productId)
    {
        Cart::remove($productId);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully removed from cart.',
            'id' => Str::random(10)
        ]);

        $this->emit('cartUpdated');
    }

    public function redirectIfCartEmpty()
    {
        if (empty(Cart::content())) {
            return redirect()->route('products.index');
        }
    }

    public function render()
    {
        $this->redirectIfCartEmpty();

        $shippingFees = Cart::shipping();

        return view('livewire.checkout.index', [
            'cartProducts' => Cart::content(),
            'shippingFees' => Format::priceWithCurrency($shippingFees),
            'totalWithTaxAndShipping' => Format::priceWithCurrency(Cart::totalWithTaxRaw() + $shippingFees),
        ]);
    }
}
