<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use App\Models\Products\Size;
use App\Traits\Livewire\HasFlashMessage;
use Livewire\Component;

class Item extends Component
{
    use HasFlashMessage;

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
        $this->sizeLetter = Size::findOrFail($this->productOptionSizeId)->name;
    }

    public function updatedQuantity(int $quantity)
    {
        if ($quantity > 0) {
            if (!Cart::verifyProductQuantity($this->productOptionId, $this->productOptionSizeId, $quantity)) {
                $this->newFlashMessage('Product does not have enough stock.', 'error');
    
                return;
            }

            Cart::update($this->productOptionId, $this->productOptionSizeId, $quantity);

            $this->newFlashMessage('Product successfully updated on cart.');

            return;
        }

        $this->removeFromCart($this->productOptionId);
    }

    public function removeFromCart(int $productId)
    {
        Cart::remove($productId, $this->productOptionSizeId);

        $this->newFlashMessage('Product successfully removed from cart.');
    }

    public function render()
    {
        $this->emit('itemChanged');
        $this->emit('cartUpdated');

        return view('livewire.cart.item');
    }
}
