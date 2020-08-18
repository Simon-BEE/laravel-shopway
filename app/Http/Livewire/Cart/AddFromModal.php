<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use App\Models\Products\ProductOption;
use Livewire\Component;
use Illuminate\Support\Str;

class AddFromModal extends Component
{
    protected $listeners = ['addToCartFromModal'];

    public function addToCartFromModal(int $id)
    {
        $product = ProductItemOption::findOrFail($id);

        Cart::add($product, $product->default_size);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully added to cart.',
            'id' => Str::random(10)
        ]);

        $this->emit('cartUpdated');
    }

    public function render()
    {
        return view('livewire.cart.add-from-modal');
    }
}
