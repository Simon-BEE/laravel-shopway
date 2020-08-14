<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Traits\Upload\ImageUpload;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use ImageUpload, WithFileUploads;

    public $product;
    public $pictures = [];
    public $name;
    public $description;
    public $price;
    public $weight;
    public $quantity;
    public $categories;

    protected $listeners = ['removeProductImage', 'setImageAsMain'];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->weight = $product->weight;
        $this->quantity = $product->quantity;
        $this->categories = Category::all();
    }

    public function setImageAsMain(int $id)
    {
        $image = Image::findOrFail($id);
        
        $image->setAsMain();

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s image has been set as main.',
            'id' => Str::random(10)
        ]);
    }

    public function removeProductImage(int $id)
    {
        $image = Image::findOrFail($id);

        if ($image->is_main) {
            $this->emit('flashMessage', [
                'type' => 'error',
                'message' => 'Product\'s main image can\'t be removed.',
                'id' => Str::random(10)
            ]);

            return;
        }

        $image->delete();

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s image has been removed definitely.',
            'id' => Str::random(10)
        ]);
    }

    function updatedPictures()
    {
        $this->validate([
            'pictures.*' => [
                'required', 'image', 'mimes:png,jpg,jpeg', 'max:2200',
            ],
        ]);

        foreach ($this->pictures as $image) {
            $fileNameWithExtension = Str::random(24) . '.' . strtolower($image->getClientOriginalExtension());
            $image->storeAs('', $fileNameWithExtension, 'products');
            $this->product->images()->create([
                'filename' => $fileNameWithExtension,
            ]);
        }

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s image has been added successfully.',
            'id' => Str::random(10)
        ]);
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

    public function render()
    {
        return view('livewire.admin.products.edit', [
            'images' => Image::where('product_id', $this->product->id)->get(),
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

    public function updatedPrice(string $newValue)
    {
        $this->validate([
            'price' => 'required|numeric|between:100,20000',
        ]);

        $this->product->update([
            'price' => $newValue,
        ]);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s price has been updated successfully.',
            'id' => Str::random(10)
        ]);
    }

    public function updatedQuantity(string $newValue)
    {
        $this->validate([
            'quantity' => 'required|numeric|between:1,2000',
        ]);

        $this->product->update([
            'quantity' => $newValue,
        ]);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s quantity has been updated successfully.',
            'id' => Str::random(10)
        ]);
    }

    public function updatedWeight(string $newValue)
    {
        $this->validate([
            'weight' => 'required|numeric|between:1,2000',
        ]);

        $this->product->update([
            'weight' => $newValue,
            'slug' => Str::slug($newValue),
        ]);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product\'s weight has been updated successfully.',
            'id' => Str::random(10)
        ]);
    }
}
