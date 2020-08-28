<?php

namespace App\Http\Livewire\Admin\Products\Options;

use Livewire\Component;
use App\Models\Products\Product;
use App\Models\Products\ProductOption;

class Card extends Component
{
    public $productOption;
    public $product;


    public function mount(ProductOption $productOption, Product $product)
    {
        $this->productOption = $productOption;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.admin.products.options.card');
    }
}
