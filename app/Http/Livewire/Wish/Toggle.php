<?php

namespace App\Http\Livewire\Wish;

use App\Models\Product;
use Livewire\Component;
use App\Models\Wish;
use Illuminate\Support\Str;

class Toggle extends Component
{
    public $product;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function addToWishlist()
    {
        if (!auth()->check()) {
            $this->emit('flashMessage', [
                'type' => 'error',
                'message' => 'You need to be connected for this.',
                'id' => Str::random(10)
            ]);
            return;
        }

        if ($this->product->isInWishlist) {
            $this->removeToWishlist();
        }else{
            Wish::create([
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
            ]);

            $this->emit('flashMessage', [
                'type' => 'success',
                'message' => 'This item has been added to your wishlist.',
                'id' => Str::random(10)
            ]);
        }

        $this->product = Product::find($this->product->id);
    }

    private function removeToWishlist()
    {
        $wish = Wish::remove($this->product->id, auth()->id());

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'This item has been removed from your wishlist.',
            'id' => Str::random(10)
        ]);
    }

    public function render()
    {
        return view('livewire.wish.toggle');
    }
}
