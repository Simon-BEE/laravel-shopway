<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => [
                'required', 'numeric', 'exists:countries,id',
            ],
            'firstname' => [
                'required', 'string', 'between:2,100',
            ],
            'lastname' => [
                'required', 'string', 'between:2,100',
            ],
            'professionnal' => [
                'nullable', 'boolean',
            ],
            'company' => [
                'nullable', 'string', 'between:2,100',
            ],
            'address' => [
                'required', 'string', 'between:10,255',
            ],
            'info_address' => [
                'nullable', 'string', 'between:2,255',
            ],
            'zipcode' => [
                'required', 'between:4,10',
            ],
            'city' => [
                'required', 'string', 'between:2,100',
            ],
            'phone' => [
                'required', 'between:6,25',
            ],
        ];
    }
}
