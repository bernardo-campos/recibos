<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreConceptRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $is_receipt = str( \Route::current()->getName() )->contains('receipt');

        $this->merge([
            'type' => $is_receipt ? 'Receipt' : 'PaymentOrder',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            'type' => 'required|in:Receipt,PaymentOrder',
            'name' => [
                'required',
                'string',
                'max:120',
                $this->method() == 'PUT' 
                ? Rule::unique('concepts')->where(function ($query) {
                    return $query->where('type', $this->type);
                })->ignore($this->concept->id) 
                : Rule::unique('concepts')->where(function ($query) {
                    return $query->where('type', $this->type);
                })
            ],
        ];
    }
}
