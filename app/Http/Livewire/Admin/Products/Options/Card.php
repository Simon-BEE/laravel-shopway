<?php

namespace App\Http\Livewire\Admin\Products\Options;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ProductItemOption;

class Card extends Component
{
    public $productOption;
    public $product;


    public function mount(ProductItemOption $productOption)
    {
        $this->productOption = $productOption;
        $this->product = $productOption->product;
    }

    public function render()
    {
        return view('livewire.admin.products.options.card');
    }
}
