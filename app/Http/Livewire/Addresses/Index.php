<?php

namespace App\Http\Livewire\Addresses;

use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    protected $listeners = ['setAddressAsMain'];

    public function setAddressAsMain(int $addressId)
    {
        // dd($addressId);
        $validator = Validator::make(['id' => $addressId,], [
            'id' => [
                'required', 'numeric', 
                Rule::exists('addresses', 'id')->where(function ($query){
                    $query->where('user_id', auth()->id());
                })
            ],
        ]);

        if ($validator->fails()) {
            $this->emit('flashMessage', [
                'type' => 'error',
                'message' => __('Address not found.'),
                'id' => Str::random(10)
            ]);

            return;
        }

        $address = Address::find($addressId);

        if (!$address->is_main) {
            $address->setAsMain();

            $this->emit('flashMessage', [
                'type' => 'success',
                'message' => __('Address set as main.'),
                'id' => Str::random(10)
            ]);
        }
        
    }

    public function render()
    {
        return view('livewire.addresses.index', [
            'addresses' => Address::allByUser()->with('country')->get(),
        ]);
    }
}
