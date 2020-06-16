<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

class Add extends Component
{
    public function addToCart(int $id)
    {
        dd($id);
    }

    public function render()
    {
        return view('livewire.cart.add');
    }
}
