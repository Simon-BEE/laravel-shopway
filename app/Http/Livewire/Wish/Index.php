<?php

namespace App\Http\Livewire\Wish;

use App\Models\Wish;
use App\Helpers\Cart;
use Livewire\Component;
use App\Models\Products\Product;
use App\Traits\Livewire\HasFlashMessage;

class Index extends Component
{
    use HasFlashMessage;

    public function addToCart(int $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            $this->newFlashMessage('Error from product.', 'error');
        }

        // Cart::add($product);

        $this->newFlashMessage('Product successfully added to cart.');

        $this->emit('cartUpdated');

        $this->removeFromWishlist($productId);
    }

    public function removeFromWishlist(int $productId)
    {
        Wish::remove($productId, auth()->id());

        $this->newFlashMessage('Product removed from wishlist.');
    }

    public function render()
    {
        return view('livewire.wish.index', [
            'wishes' => Wish::wishlist()->get(),
        ]);
    }
}
