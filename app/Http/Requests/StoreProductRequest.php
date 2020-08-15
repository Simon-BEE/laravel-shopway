<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => [
                'required', 'string', 'between:5,150',
            ],
            'description' => [
                'required', 'string', 'min:40',
            ],
            'categories' => [
                'required', 'array', 'min:1',
            ],
            'categories.*' => [
                'required', 'numeric', 'exists:categories,id',
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            $failedRules = $validator->failed();
            if (!empty($failedRules)) {
                session()->flash('type', 'error');
                session()->flash('message', 'Please fill correctly the form.');
            }
        });
    }
}
