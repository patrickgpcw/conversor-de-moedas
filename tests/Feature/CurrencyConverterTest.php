<?php

namespace Tests\Feature;

use App\Models\Currency;
use Tests\TestCase;

class CurrencyConverterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_return_json_with_result_convert_and_quotation_used()
    {
        $data = [
            'base' => 'BRL',
            'to' => 'USD',
            'value' => 3,
        ];

        $currency = Currency::where('base', $data['base'])->where('to', $data['to'])->first();
        $quotationUsed = $currency->value;

        $response = $this->json('GET', '/api/converter', $data);

        $response->assertExactJson([
            'convert_result' => round($quotationUsed * $data['value'], 2),
            'quotation_used' => $quotationUsed,
        ]);
    }

    public function test_should_return_422_when_wrong_params()
    {
        $data = [
            'base' => 'brl',
            'to' => 'MX',
            'value' => -333,
        ];

        $response = $this->json('GET', '/api/converter', $data);

        $response->assertStatus(422);
    }

    public function test_sould_return_422_when_base_and_to_are_equal()
    {
        $data = [
            'base' => 'BRL',
            'to' => 'BRL',
            'value' => 5,
        ];

        $response = $this->json('GET', '/api/converter', $data);

        $response->assertStatus(422);
    }
}
