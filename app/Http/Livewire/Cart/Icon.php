<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use Livewire\Component;

class Icon extends Component
{
    protected $listeners = ['cartUpdated' => "render"];

    public function render()
    {
        return view('livewire.cart.icon', [
            'cartAmount' => Cart::content() ? count(Cart::content()) : 0,
        ]);
    }
}
