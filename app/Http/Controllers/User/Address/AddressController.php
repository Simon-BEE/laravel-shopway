<?php

namespace App\Http\Controllers\User\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\Country;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.addresses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.addresses.create', [
            'countries' => Country::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        // dd(request()->all());
        $validatedData = $request->validated();

        auth()->user()->addresses()->create($validatedData);

        return redirect()->route('users.addresses.index')->with([
            'type' => 'success',
            'message' => __('Address has been recorded.')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);

        $alert = ['type' => 'error', 'message' => __('Main address can\'t be deleted.')];

        if (!$address->is_main) {
            $address->delete();
            
            $alert = ['type' => 'success', 'message' => __('Address has been deleted successfully.')];
        }


        return back()->with([
            'type' => $alert['type'],
            'message' => $alert['message'],
        ]);
    }
}
