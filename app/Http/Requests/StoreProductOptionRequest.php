<?php

namespace App\Http\Requests;

use App\Models\Option;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductOptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasRoles('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weight' => [
                'nullable', 'numeric', 'between:1,2000',
            ],
            'price' => [
                'required', 'numeric', 'between:100,20000',
            ],
            'images' => [
                'required', 'array', 'min:1',
            ],
            'images.*' => [
                'required', 'image', 'mimes:png,jpg,jpeg', 'max:2200',
            ],
            'quantities.*' => [
                'nullable', 'numeric', 'between:0,20000',
            ],
            'color_id' => [
                'required', 'numeric', 'exists:colors,id',
            ],
            'material_id' => [
                'required', 'numeric', 'exists:materials,id',
            ],
            'another_form' => [
                'sometimes', 'nullable',
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            $failedRules = $validator->failed();
            if (!empty($failedRules)) {
                // dd($failedRules);
                session()->flash('type', 'error');
                session()->flash('message', 'Please fill correctly the form.');
            }
        });
    }
}
