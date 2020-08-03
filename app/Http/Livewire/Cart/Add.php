<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Str;

class Add extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart()
    {
        Cart::add($this->product);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully added to cart.',
            'id' => Str::random(10)
        ]);

        $this->emit('cartUpdated');
    }

    public function render()
    {

        return view('livewire.cart.add');
    }
}
