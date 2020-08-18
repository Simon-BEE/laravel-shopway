<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Orders\Order;
use Livewire\Component;
use Livewire\WithPagination;
use App\Traits\Classify\IsFilterableWithLivewire;

class Index extends Component
{
    use WithPagination, IsFilterableWithLivewire;

    public function mount()
    {
        $this->sortField = 'id';
        $this->sortAsc = false;
    }

    public function render()
    {
        return view('livewire.admin.orders.index', [
            'orders' => Order::where('price', 'like' , "%$this->searchTerm%")
                ->orWhere('created_at', 'like' , "%$this->searchTerm%")
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
            ,
        ]);
    }
}
