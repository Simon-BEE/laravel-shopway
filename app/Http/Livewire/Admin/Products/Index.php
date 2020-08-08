<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use App\Traits\Classify\IsFilterableWithLivewire;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, IsFilterableWithLivewire;

    public function render()
    {
        return view('livewire.admin.products.index', [
            'products' => Product::where('name', 'like' , "%$this->searchTerm%")
                ->with(['images', 'categories'])
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
            ,
        ]);
    }
}
