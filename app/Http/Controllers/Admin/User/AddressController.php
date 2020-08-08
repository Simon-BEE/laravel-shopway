<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Address;

class AddressController extends Controller
{
    public function destroy(Address $address)
    {
        $address->delete();

        return back()->with([
            'type' => 'success',
            'message' => 'Address has been removed.'
        ]);
    }
}
