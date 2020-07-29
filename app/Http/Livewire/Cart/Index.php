<?php

namespace App\Http\Livewire\Cart;

use App\Helpers\Cart;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['itemChanged' => "render"];

    public function render()
    {
        return view('livewire.cart.index', [
            'cartProducts' => session('cart') ?? [],
            'totalWithoutTax' => Cart::totalWithoutTax(),
            'totalWithTax' => Cart::totalWithTax(),
            'totalTax' => Cart::totalTax(),
        ]);
    }
}
