<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyApiController extends Controller
{
    public function converter(Request $request)
    {
        $avaliablesCurrencies = ['BRL', 'USD', 'EUR'];

        $request->validate([
            'base' => ['required', Rule::in($avaliablesCurrencies), 'different:to'],
            'to' => ['required', Rule::in($avaliablesCurrencies)],
            'value' => ['required', 'numeric', 'min:0'],
        ]);

        $payload = $request->only([
            'base',
            'to',
            'value',
        ]);

        $currency = Currency::base($payload['base'])->to($payload['to'])->first();

        $quotationUsed = $currency->value;

        $data = [
            'convert_result' => round($quotationUsed * $payload['value'], 2),
            'quotation_used' => $quotationUsed,
        ];

        return response()->json($data);
    }
}
