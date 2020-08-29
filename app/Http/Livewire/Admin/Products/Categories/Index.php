<?php

namespace App\Http\Livewire\Admin\Products\Categories;

use Livewire\Component;
use App\Models\Products\Category;
use App\Traits\Livewire\IsFilterable;
use App\Traits\Livewire\FieldValidator;
use App\Traits\Livewire\HasFlashMessage;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, IsFilterable, FieldValidator, HasFlashMessage;

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

        $this->newFlashMessage('Category\'s name has been updated successfully.');
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
