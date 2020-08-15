<?php

namespace App\Http\Livewire\Admin\Products\Options;

use App\Models\ProductItemOption;
use Livewire\Component;

class Edit extends Component
{
    public $productOption;

    public function mount(ProductItemOption $productOption)
    {
        $this->productOption = $productOption;
    }

    public function render()
    {
        return view('livewire.admin.products.options.edit', [
            'images' => $this->productOption->images,
        ]);
    }
}
