<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $product;
    public $name;
    public $description;
    public $price;
    public $weight;
    public $quantity;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->weight = $product->weight;
        $this->quantity = $product->quantity;
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

    public function render()
    {
        return view('livewire.admin.products.edit');
    }
}
