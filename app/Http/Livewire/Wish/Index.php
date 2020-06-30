<?php

namespace App\Http\Livewire\Wish;

use App\Models\Reference;
use App\Models\Wish;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\Cart\CartManager;

class Index extends Component
{


    public function addToCart(CartManager $cartManager, int $referenceId)
    {
        $reference = Reference::find($referenceId);

        if (!$reference) {
            $this->emit('flashMessage', [
                'type' => 'error',
                'message' => 'Error from product.',
                'id' => Str::random(10)
            ]);
        }

        $cartManager->add($reference);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully added to cart.',
            'id' => Str::random(10)
        ]);

        $this->emit('cartUpdated');

        $this->removeFromWishlist($referenceId);
    }

    public function removeFromWishlist(int $referenceId)
    {
        Wish::remove($referenceId, auth()->id());

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
