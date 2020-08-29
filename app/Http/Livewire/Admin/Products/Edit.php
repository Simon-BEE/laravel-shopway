<?php

namespace App\Http\Livewire\Admin\Products;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Products\Product;
use App\Models\Products\Category;
use App\Traits\Upload\ImageUpload;
use App\Traits\Livewire\HasFlashMessage;

class Edit extends Component
{
    use ImageUpload, WithFileUploads, HasFlashMessage;

    public $product;
    public $name;
    public $description;
    public $categories;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->categories = Category::all();
    }

    public function updateCategories(int $categoryId)
    {
        if ($this->product->categories->count() <= 1) {
            if ($this->product->categories->contains('id', $categoryId)) {
                $this->newFlashMessage('Last product\'s category can\'t be removed.', 'error');
                return;
            }
            $this->product->categories()->attach($categoryId);
        }else{
            $this->product->categories()->toggle($categoryId);
        }

        $this->newFlashMessage('Product\'s categories has been updated successfully.');
    }

    public function updatedName(string $newValue)
    {
        $this->validate([
            'name' => 'required|string|between:3,100',
        ]);

        $this->product->update([
            'name' => $newValue,
            'slug' => Str::slug($newValue),
        ]);

        $this->newFlashMessage('Product\'s name has been updated successfully.');
    }

    public function updatedDescription(string $newValue)
    {
        $this->validate([
            'description' => 'required|string|min:40',
        ]);

        $this->product->update([
            'description' => $newValue,
        ]);

        
        $this->newFlashMessage('Product\'s description has been updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.products.edit');
    }
}
