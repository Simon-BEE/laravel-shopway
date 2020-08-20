<?php

namespace App\Http\Livewire\Admin\Products\Categories;

use Livewire\Component;
use App\Models\Products\Category;
use App\Traits\Classify\IsFilterableWithLivewire;
use App\Traits\Validator\FieldWithLivewire;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, IsFilterableWithLivewire, FieldWithLivewire;

    public function updateCategory(int $id, string $value)
    {
        if (!$this->isRequiredNumericAndExists('id', $id, 'categories') || 
            !$this->isUnique('name', $value, 'categories', $id)) {
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
