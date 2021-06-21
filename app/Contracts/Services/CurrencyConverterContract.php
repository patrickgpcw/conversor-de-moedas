<?php

namespace App\Contracts\Services;

interface CurrencyConverterContract
{
    public function getQuota($base, $to): float;
}
