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
            'title' => [
                'required', 'string', 'between:5,150',
            ],
            'description' => [
                'required', 'string', 'min:40',
            ],
            'references' => [
                'required', 'array',
            ],
            'references.*.name' => [
                'required', 'string', 'between:5,150',
            ],
            'references.*.color' => [
                'nullable', 'string', 'between:1,30',
            ],
            'references.*.size' => [
                'nullable', 'numeric', 'between:1,2000',
            ],
            'references.*.weight' => [
                'nullable', 'numeric', 'between:1,2000',
            ],
            'references.*.price' => [
                'required', 'numeric', 'between:1,2000',
            ],
            'references.*.quantity' => [
                'required', 'numeric', 'between:1,2000',
            ],
        ];
    }

    public function withValidator($validator)
    {
        // dd($validator);
        $validator->after(function ($validator){
            $failedRules = $validator->failed();
            if (isset($failedRules['references']) && isset($failedRules['references']['Required'])) {
                session()->flash('type', 'error');
                session()->flash('message', 'You need to add at least one reference.');
            }elseif (!empty($failedRules)) {
                session()->flash('type', 'error');
                session()->flash('message', 'Please fill correctly the form.');
            }
        });
    }
}
