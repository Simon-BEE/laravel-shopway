<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductItemOption;
use App\Traits\Upload\ImageUpload;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use ImageUpload, WithFileUploads;

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
                $this->emit('flashMessage', [
                    'type' => 'success',
                    'message' => 'Last product\'s category can\'t be removed.',
                    'id' => Str::random(10)
                ]);
                return;
            }
            $this->product->categories()->attach($categoryId);
        }else{
            $this->product->categories()->toggle($categoryId);
        }

        
        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s categories has been updated successfully.',
            'id' => Str::random(10)
        ]);
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

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s name has been updated successfully.',
            'id' => Str::random(10)
        ]);
    }

    public function updatedDescription(string $newValue)
    {
        $this->validate([
            'description' => 'required|string|min:40',
        ]);

        $this->product->update([
            'description' => $newValue,
        ]);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s description has been updated successfully.',
            'id' => Str::random(10)
        ]);
    }

    public function render()
    {
        return view('livewire.admin.products.edit');
    }
}
