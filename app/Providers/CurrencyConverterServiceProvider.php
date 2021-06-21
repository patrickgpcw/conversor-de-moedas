<?php

namespace App\Providers;

use App\Contracts\Services\CurrencyConverterContract;
use App\Services\AwesomeApiService;
use Illuminate\Support\ServiceProvider;

class CurrencyConverterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyConverterContract::class, AwesomeApiService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
