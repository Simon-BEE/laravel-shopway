<?php

namespace App\Http\Livewire\Admin\Products\Options;

use Livewire\Component;
use App\Models\Products\ProductOption;

class Card extends Component
{
    public $productOption;
    public $product;


    public function mount(ProductOption $productOption)
    {
        $this->productOption = $productOption;
        $this->product = $productOption->product;
    }

    public function render()
    {
        return view('livewire.admin.products.options.card');
    }
}
