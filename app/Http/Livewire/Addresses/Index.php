<?php

namespace App\Http\Livewire\Addresses;

use App\Models\Users\Address;
use App\Traits\Livewire\HasFlashMessage;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Index extends Component
{
    use HasFlashMessage;

    protected $listeners = ['setAddressAsMain'];

    public function setAddressAsMain(int $addressId)
    {
        $validator = Validator::make(['id' => $addressId,], [
            'id' => [
                'required', 'numeric', 
                Rule::exists('addresses', 'id')->where(function ($query){
                    $query->where('user_id', auth()->id());
                })
            ],
        ]);

        if ($validator->fails()) {
            $this->newFlashMessage('Address not found.', 'error');

            return;
        }

        $address = Address::find($addressId);

        if (!$address->is_main) {
            $address->setAsMain();

            $this->newFlashMessage('Address mark as main.');
        }
        
    }

    public function render()
    {
        return view('livewire.addresses.index', [
            'addresses' => Address::allByUser()->with('country')->get(),
        ]);
    }
}
