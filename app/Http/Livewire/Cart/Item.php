<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\Cart\CartManager;

class Item extends Component
{
    public $reference;
    public $referenceId;
    public $quantity;

    public function mount(int $referenceId, array $reference)
    {
        $this->referenceId = $referenceId;
        $this->reference = $reference;
        $this->quantity = $reference['quantity'];
    }

    public function updatedQuantity(int $quantity)
    {
        if ($quantity > 0) {
            $cartManager = new CartManager();
            $cartManager->update($this->referenceId, $quantity);

            $this->emit('flashMessage', [
                'type' => 'success',
                'message' => 'Product successfully updated on cart.',
                'id' => Str::random(6)
            ]);

            return;
        }

        $this->removeFromCart($this->referenceId);
    }

    public function removeFromCart(int $referenceId)
    {
        $cartManager = new CartManager();
        $cartManager->remove($referenceId);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully removed from cart.',
            'id' => Str::random(6)
        ]);
    }

    public function render()
    {
        $this->emit('itemChanged');
        $this->emit('cartUpdated');

        return view('livewire.cart.item');
    }
}
