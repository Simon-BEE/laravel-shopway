<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use App\Models\Option;
use Livewire\Component;
use App\Models\Products\Product;
use App\Models\Products\ProductOption;
use Illuminate\Support\Str;

class Add extends Component
{
    public $productSelected;
    public $selectedSize;

    public function mount(ProductItemOption $productSelected, Option $selectedSize)
    {
        $this->productSelected = $productSelected;
        $this->selectedSize = $selectedSize;
    }

    public function addToCart()
    {
        Cart::add($this->productSelected, $this->selectedSize->id);

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
