<?php

namespace App\Http\Livewire\Products;

use App\Models\Products\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    public function updatedSearch()
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        return view('livewire.products.index', [
            'products' => Product::with(['wishes', 'images', 'product_options'])
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->paginate(12),
        ]);
    }
}
