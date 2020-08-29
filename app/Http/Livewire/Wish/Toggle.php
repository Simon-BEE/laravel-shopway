<?php

namespace App\Http\Livewire\Wish;

use App\Models\Wish;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Products\Product;
use App\Traits\Livewire\HasFlashMessage;

class Toggle extends Component
{
    use HasFlashMessage;

    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToWishlist()
    {
        if (!auth()->check()) {
            $this->newFlashMessage('You need to be connected for this.', 'error');
            return;
        }

        if ($this->product->isInWishlist) {
            $this->removeToWishlist();
        }else{
            Wish::create([
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
            ]);

            $this->newFlashMessage('This item has been added to your wishlist.');
        }

        $this->product = Product::find($this->product->id);
    }

    private function removeToWishlist()
    {
        $wish = Wish::remove($this->product->id, auth()->id());

        $this->newFlashMessage('This item has been removed to your wishlist.');
    }

    public function render()
    {
        return view('livewire.wish.toggle');
    }
}
