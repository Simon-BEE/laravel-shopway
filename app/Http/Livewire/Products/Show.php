<?php

namespace App\Http\Livewire\Products;

use App\Helpers\Cart;
use App\Models\Products\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Products\ProductOption;
use Illuminate\Support\Collection;

class Show extends Component
{
    public $product;
    public $sizes;
    public $selectedProduct;
    public $selectedSize;
    public $selectedImage;

    public function mount(Product $product, Collection $sizes)
    {
        $this->product = $product;
        $this->sizes = $sizes;
        $this->selectedProduct = $product->first_option;
        $this->selectedSize = $this->selectedProduct->default_size;
    }

    public function selectOption(int $productOptionId)
    {
        if ($this->selectedProduct->id === $productOptionId) {
            return;
        }

        $this->selectedProduct = ProductOption::findOrFail($productOptionId);

        if (!$this->selectedProduct->hasSize($this->selectedSize->id)) {
            $this->selectedSize = $this->selectedProduct->default_size;
        }
    }

    public function selectSizeOption(int $sizeId)
    {
        if ($this->selectedSize->id === $sizeId ||
            !$this->selectedProduct->hasSize($sizeId) || 
            !$this->selectedProduct->whereSizeIs($sizeId)->hasEnoughQuantity()
        ) {
            return;
        }

        $this->selectedSize = $this->selectedProduct->whereSizeIs($sizeId);
    }

    public function addToCart()
    {
        if(!$this->selectedProduct->whereSizeIs($this->selectedSize->id)->hasEnoughQuantity()){
            $this->emit('flashMessage', [
                'type' => 'error',
                'message' => 'Product has no stock.',
                'id' => Str::random(10)
            ]);
            return;
        }

        Cart::add($this->selectedProduct, $this->selectedSize->id);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully added to cart.',
            'id' => Str::random(10)
        ]);

        $this->emit('cartUpdated');
    }

    public function render()
    {
        return view('livewire.products.show');
    }
}
