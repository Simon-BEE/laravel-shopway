<?php

namespace App\Http\Livewire\Wish;

use Livewire\Component;
use App\Models\Reference;
use App\Models\Wish;
use Illuminate\Support\Str;

class Toggle extends Component
{
    public $reference;

    public function mount(Reference $reference)
    {
        $this->reference = $reference;
    }

    public function addToWishlist()
    {
        if (!auth()->check()) {
            $this->emit('flashMessage', [
                'type' => 'error',
                'message' => 'You need to be connected for this.',
                'id' => Str::random(10)
            ]);
            return;
        }

        if ($this->reference->isInWishlist) {
            $this->removeToWishlist();
        }else{
            Wish::create([
                'user_id' => auth()->id(),
                'reference_id' => $this->reference->id,
            ]);

            $this->emit('flashMessage', [
                'type' => 'success',
                'message' => 'This item has been added to your wishlist.',
                'id' => Str::random(10)
            ]);
        }

        $this->reference = Reference::find($this->reference->id);
    }

    private function removeToWishlist()
    {
        $wish = Wish::remove($this->reference->id, auth()->id());

        $this->emit('flashMessage', [
            'type' => 'success',
            'message' => 'This item has been removed from your wishlist.',
            'id' => Str::random(10)
        ]);
    }

    public function render()
    {
        return view('livewire.wish.toggle');
    }
}
