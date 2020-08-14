<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use App\Models\Option;
use Livewire\Component;
use Illuminate\Support\Str;

class Item extends Component
{
    public $productOption;
    public $productOptionId;
    public $productOptionSizeId;
    public $quantity;
    public $sizeLetter;

    public function mount(int $productOptionId, int $productOptionSizeId, array $productOption)
    {
        $this->productOptionId = $productOptionId;
        $this->productOptionSizeId = $productOptionSizeId;
        $this->productOption = $productOption;
        $this->quantity = $productOption['quantity'];
        $this->sizeLetter = Option::MAP_SIZES[$this->productOptionSizeId];
    }

    public function updatedQuantity(int $quantity)
    {
        if ($quantity > 0) {
            Cart::update($this->productOptionId, $this->productOptionSizeId, $quantity);

            $this->emit('flashMessage', [
                'type' => 'success',
                'message' => 'Product successfully updated on cart.',
                'id' => Str::random(10)
            ]);

            return;
        }

        $this->removeFromCart($this->productOptionId);
    }

    public function removeFromCart(int $productId)
    {
        Cart::remove($productId, $this->productOptionSizeId);

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
