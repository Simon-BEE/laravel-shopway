<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    // public function paginationView()
    // {
    //     return 'vendor.pagination.livewire-tailwind';
    // }

    public function updatedSearch()
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        return view('livewire.products.index', [
            'products' => Product::with('wishes')->where('name', 'like', '%' . $this->search . '%')->paginate(12),
        ]);
    }
}
