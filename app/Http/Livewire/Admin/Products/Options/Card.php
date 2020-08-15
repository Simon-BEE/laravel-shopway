<?php

namespace App\Http\Livewire\Admin\Products\Options;

use Livewire\Component;
use App\Models\ProductItemOption;

class Card extends Component
{
    public $productOption;

    public function mount(ProductItemOption $productOption)
    {
        $this->productOption = $productOption;
    }

    public function render()
    {
        return view('livewire.admin.products.options.card');
    }
}
