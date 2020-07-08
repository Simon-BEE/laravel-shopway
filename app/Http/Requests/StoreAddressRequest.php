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
            'name' => [
                'required', 'string', 'between:2,100',
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
                'nullable', 'required_if:professionnal,1', 'exclude_unless:professionnal,1', 'string', 'between:2,100',
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

    public function messages()
    {
        return [
            'company.required_if' => __('The company field is required when professionnal is checked. '),
        ];
    }
}
