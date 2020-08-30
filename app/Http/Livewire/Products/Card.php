<?php

namespace App\Http\Livewire\Products;

use App\Models\Products\Product;
use Livewire\Component;

class Card extends Component
{
    public $product;

    protected $listeners = ['refreshCard' => 'refresh'];

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.products.card');
    }
}
