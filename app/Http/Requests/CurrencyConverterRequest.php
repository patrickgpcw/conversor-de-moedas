<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyConverterRequest extends FormRequest
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
        $availablesCurrencies = ['BRL', 'USD', 'EUR'];

        return [
            'base' => ['required', Rule::in($availablesCurrencies), 'different:to'],
            'to' => ['required', Rule::in($availablesCurrencies)],
            'value' => ['required', 'numeric', 'gt:0'],
        ];
    }
}
