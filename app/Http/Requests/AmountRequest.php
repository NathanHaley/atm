<?php

namespace App\Http\Requests;

use App\Transaction;
use Illuminate\Foundation\Http\FormRequest;
use Cknow\Money\Money;

class AmountRequest extends FormRequest
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
            'amount' => [
                'required',
                'numeric',
                'min:'.Transaction::MIN,
                'max:'.Transaction::MAX,
                'regex:/^\d+(\.\d{1,2})?$/'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'amount.regex' => 'Please enter amount in formats like 10, 10.00, 10.5 with no dollar sign or commas',
            'amount.max' => 'For amount greater than '.Money::USD(Transaction::MAX)->format().' call 1-555-555-RICH'
        ];
    }
}
