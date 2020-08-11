<?php

namespace App\Http\Livewire\Products;

use App\Models\Option;
use App\Models\Product;
use App\Models\ProductItemOption;
use Illuminate\Support\Collection;
use Livewire\Component;

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
        // $this->selectedImage = $this->selectedProduct->main_image;
    }

    public function selectOption(int $productOptionId)
    {
        if ($this->selectedProduct->id === $productOptionId) {
            return;
        }

        $this->selectedProduct = ProductItemOption::findOrFail($productOptionId);
        // $this->selectedImage = $this->selectedProduct->main_image;

        if (!$this->selectedProduct->hasSize($this->selectedSize->id)) {
            $this->selectedSize = $this->selectedProduct->default_size;
        }
    }

    public function selectSizeOption(int $sizeId)
    {
        if ($this->selectedSize->id === $sizeId) {
            return;
        }

        if (!$this->selectedProduct->hasSize($sizeId)) {
            return;
        }

        $this->selectedSize = Option::where('id', $sizeId)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.products.show');
    }
}
