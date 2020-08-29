<?php

namespace App\Http\Livewire\Admin\Products\Options;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Products\{Product, ProductOption, Size, Color, Material, Image};
use App\Traits\Upload\ImageUpload;
use App\Traits\Livewire\FieldValidator;
use App\Traits\Livewire\HasFlashMessage;

class Edit extends Component
{
    use ImageUpload, WithFileUploads, FieldValidator, HasFlashMessage;

    public $product;
    public $productOption;
    public $pictures = [];
    public $price;
    public $weight;
    public $quantity;
    public $sizes;
    public $materials;
    public $colors;

    protected $listeners = ['removeProductImage', 'setImageAsMain'];

    public function mount(Product $product, ProductOption $productOption)
    {
        $this->product = $product;
        $this->productOption = $productOption;
        $this->price = $productOption->price;
        $this->weight = $productOption->weight;
        $this->quantity = $productOption->quantity;
        $this->sizes = Size::all();
        $this->materials = Material::all();
        $this->colors = Color::all();
    }

    public function setImageAsMain(int $id)
    {
        $image = Image::findOrFail($id);
        
        $image->setAsMain();

        $this->newFlashMessage('Product\'s image has been marked as main.');
    }

    public function removeProductImage(int $id)
    {
        $image = Image::findOrFail($id);

        if ($image->is_main) {
            $this->newFlashMessage('Product\'s main image can\'t be removed.', 'error');

            return;
        }

        $image->delete();

        $this->newFlashMessage('Product\'s image has been removed definitely.');
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
            $this->productOption->images()->create([
                'filename' => $fileNameWithExtension,
            ]);
        }

        $this->newFlashMessage('Product\'s image has been added successfully.');
    }

    public function updatedPrice(string $newValue)
    {
        $this->validate([
            'price' => 'required|numeric|between:100,20000',
        ]);

        $this->productOption->update([
            'price' => $newValue,
        ]);

        $this->newFlashMessage('Product\'s price has been updated successfully.');
    }

    public function updatedWeight(string $newValue)
    {
        $this->validate([
            'weight' => 'required|numeric|between:1,2000',
        ]);

        $this->productOption->update([
            'weight' => $newValue,
        ]);

        $this->newFlashMessage('Product\'s weight has been updated successfully.');
    }

    public function updateSize(int $sizeId, $value)
    {
        if ($value < 0 || $value > 20000) {
            return;
        }

        if (!$this->isRequiredNumericAndExists('size_id', $sizeId, 'sizes')) {
            return;
        }

        if ($this->productOption->hasSize($sizeId)) {
            if ($value > 0) {
                $this->productOption->sizes()->where('id', $sizeId)->first()->pivot->update(['quantity' => $value]);
            }else{
                $this->productOption->sizes()->detach($sizeId);
            }
        }else{
            $this->productOption->sizes()->attach([$sizeId => ['quantity' => $value]]);
        }

        $this->newFlashMessage('Product\'s size available has been updated successfully.');
    }

    public function uncheckIfNeeded(int $sizeId, bool $checked)
    {
        if ($checked) {
            return;
        }

        if (!$this->isRequiredNumericAndExists('size_id', $sizeId, 'sizes')) {
            return;
        }

        $this->productOption->sizes()->detach($sizeId);

        $this->newFlashMessage('Size has been removed.');
    }

    public function updateMaterial(int $materialId)
    {
        if ($this->productOption->material->id === $materialId) {
            return;
        }

        if (!$this->isRequiredNumericAndExists('material_id', $materialId, 'materials')) {
            return;
        }

        $this->productOption->update([
            'material_id' => $materialId,
        ]);

        $this->newFlashMessage('Product\'s material has been updated successfully.');
    }

    public function updateColor(int $colorId)
    {
        if ($this->productOption->color->id === $colorId) {
            return;
        }

        if (!$this->isRequiredNumericAndExists('color_id', $colorId, 'colors')) {
            return;
        }

        $this->productOption->update([
            'color_id' => $colorId,
        ]);

        $this->newFlashMessage('Product\'s color has been updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.products.options.edit', [
            'images' => $this->productOption->images()->get(),
        ]);
    }
}
