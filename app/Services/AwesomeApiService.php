<?php

namespace App\Services;

use App\Contracts\Services\CurrencyConverterContract;
use App\Exceptions\CurrencyConverter\QuotaServiceException;
use Illuminate\Support\Facades\Http;

class AwesomeApiService implements CurrencyConverterContract
{

    public function getQuota($base, $to): float
    {
        $response = Http::get("https://economia.awesomeapi.com.br/last/$base-$to");

        if ($response->successful()) {
            return (float) $response->json($base . $to)['high'];
        }

        throw new QuotaServiceException();
    }
}
