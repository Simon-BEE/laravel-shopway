<?php

namespace App\Http\Livewire\Wish;

use App\Helpers\Cart;
use App\Models\Products\Product;
use App\Models\Wish;
use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{


    public function addToCart(int $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            $this->emit('flashMessage', [
                'type' => 'error',
                'message' => 'Error from product.',
                'id' => Str::random(10)
            ]);
        }

        Cart::add($product);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully added to cart.',
            'id' => Str::random(10)
        ]);

        $this->emit('cartUpdated');

        $this->removeFromWishlist($productId);
    }

    public function removeFromWishlist(int $productId)
    {
        Wish::remove($productId, auth()->id());

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product removed from your wishlist.',
            'id' => Str::random(10)
        ]);
    }

    public function render()
    {
        return view('livewire.wish.index', [
            'wishes' => Wish::wishlist()->get(),
        ]);
    }
}
