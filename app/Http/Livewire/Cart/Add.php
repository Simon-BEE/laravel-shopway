<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Services\Cart\CartManager;

class Add extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToCart(CartManager $cartManager)
    {
        $cartManager->add($this->product);

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
