<?php

namespace App\Http\Livewire\Cart;

use Livewire\Component;

class Icon extends Component
{
    protected $listeners = ['cartUpdated' => "render"];

    public function render()
    {
        return view('livewire.cart.icon', [
            'cartAmount' => session('cart') ? count(session('cart')) : 0,
        ]);
    }
}
