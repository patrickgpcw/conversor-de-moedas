<?php

namespace App\Repositories\API;

use App\Contracts\Services\CurrencyConverterContract;
use App\Models\Currency;
use Exception;

class CurrencyApiConverterRepository
{
    private $currencyConverter;

    public function __construct(CurrencyConverterContract $currencyConverter)
    {
        $this->currencyConverter = $currencyConverter;
    }

    public function convert($payload)
    {
        $quotationUsed = $this->getQuotationUsed($payload['base'], $payload['to']);

        return [
            'convert_result' => round($quotationUsed * $payload['value'], 2),
            'quotation_used' => $quotationUsed,
        ];
    }

    private function getQuotationUsed(string $base, string $to)
    {
        try {
            return $this->currencyConverter->getQuota($base, $to);
        } catch (Exception $e) {
            $currency = Currency::base($base)->to($to)->first();
            return $currency->value;
        }
    }
}
