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
    public $currentPage = 1;

    // public function paginationView()
    // {
    //     return 'vendor.pagination.tailwind';
    // }

    public function updatedSearch()
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        // dd(Product::with('references')->where('title', 'like', '%' . $this->search . '%')->paginate(12));
        return view('livewire.products.index', [
            'products' => Product::with('references.wishes')->where('title', 'like', '%' . $this->search . '%')->paginate(12),
        ]);
    }
}
