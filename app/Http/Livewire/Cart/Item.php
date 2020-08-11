<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use Livewire\Component;
use Illuminate\Support\Str;

class Item extends Component
{
    public $product;
    public $productId;
    public $quantity;

    public function mount(int $productId, array $product)
    {
        dd($product);
        $this->productId = $productId;
        $this->product = $product;
        $this->quantity = $product['quantity'];
    }

    public function updatedQuantity(int $quantity)
    {
        if ($quantity > 0) {
            Cart::update($this->productId, $quantity);

            $this->emit('flashMessage', [
                'type' => 'success',
                'message' => 'Product successfully updated on cart.',
                'id' => Str::random(10)
            ]);

            return;
        }

        $this->removeFromCart($this->productId);
    }

    public function removeFromCart(int $productId)
    {
        Cart::remove($productId);

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'Product successfully removed from cart.',
            'id' => Str::random(10)
        ]);
    }

    public function render()
    {
        $this->emit('itemChanged');
        $this->emit('cartUpdated');

        return view('livewire.cart.item');
    }
}
