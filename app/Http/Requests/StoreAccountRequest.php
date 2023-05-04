<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        // TODO: mejorar el mensaje de error
        return [
            'number.unique'    => 'Ya existe una cuenta con estos tres valores',
            'bank_id.unique'   => 'Ya existe una cuenta con estos tres valores',
            'branch.unique'    => 'Ya existe una cuenta con estos tres valores',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = Rule::unique('accounts')
                    ->where('number', $this->number)
                    ->where('bank_id', $this->bank_id)
                    ->where('branch', $this->branch);
        return [
            'number'    => 'required|regex:/^[0-9]*\/?[0-9]+$/|' . $unique,
            'bank_id'   => 'required|exists:App\Models\Bank,id|' . $unique,
            'branch'    => 'required|string|max:120|' . $unique,
        ];
    }
}
