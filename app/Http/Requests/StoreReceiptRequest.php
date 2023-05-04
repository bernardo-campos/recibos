<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReceiptRequest extends FormRequest
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
            'date'              => 'required|date',
            'date_string'       => 'required|string|max:255',
            'from_id'           => 'required|exists:App\Models\From,id',
            'concept_id'        => 'required|exists:App\Models\Concept,id',
            'amount_total'      => 'required|numeric|gt:0',
            'amount_total_words'=> 'required|string|max:255',
            'type'              => 'required|in:1,2,3,4,5,Efectivo,Cheque,Depósito,Transferencia,Otro',
            'account_id'        => [
                'nullable',
                'required_if:type,2,3,4,Cheque,Depósito,Transferencia',
                'prohibited_if:type,1,5,Efectivo,Otro',
                'exists:App\Models\Account,id',
            ],
            'note'              => 'required|string|max:255',
        ];
    }
}
