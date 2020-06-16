<?php

namespace App\Http\Livewire\Cart;

use App\Models\Reference;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\Cart\CartManager;

class AddFromModal extends Component
{
    protected $listeners = ['addToCartFromModal'];

    public function addToCartFromModal(CartManager $cartManager, int $id)
    {
        $cartManager->add(Reference::findOrFail($id));

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully added to cart.',
            'id' => Str::random(6)
        ]);
    }

    public function render()
    {
        return view('livewire.cart.add-from-modal');
    }
}
