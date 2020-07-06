<?php

namespace App\Http\Livewire\Admin\Products\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $searchTerm;
    public $sortField ='name';
    public $sortAsc = true;

    public function updatedSearchTerm($value)
    {
        $this->gotoPage(1);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        }else{
            $this->sortAsc = true;
        }

        $this->sortField = $field;

        $this->gotoPage(1);
    }

    public function render()
    {
        return view('livewire.admin.products.categories.index', [
            'categories' => Category::where('name', 'like' , "%$this->searchTerm%")
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
            ,
        ]);
    }
}
