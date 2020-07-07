<?php

namespace App\Http\Livewire\Admin\Products\Categories;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $searchTerm;
    public $sortField ='name';
    public $sortAsc = true;
    public $newCategory;

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

    public function updateCategory(int $id, string $value)
    {        
        $validator = Validator::make([
                'id' => $id,
                'name' => $value,
            ], [
                'id' => 'required|numeric|exists:categories,id',
                'name' => [
                    'required', 'string', 'between:3,150', 
                    Rule::unique('categories', 'name')->ignore($id)
                ],
        ]);

        if ($validator->fails()) {
            $this->emit('flashMessage', [
                'type' => 'error',
                'message' => 'Please fill the form correctly.',
                'id' => Str::random(10)
            ]);

            return;
        }

        $category = Category::find($id);

        $category->update([
            'name' => $value,
        ]);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Category\'s name has been edited.',
            'id' => Str::random(10)
        ]);
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
