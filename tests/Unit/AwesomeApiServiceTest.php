<?php

namespace Tests\Unit;

use App\Exceptions\CurrencyConverter\QuotaServiceException;
use App\Services\AwesomeApiService;
use Illuminate\Support\Facades\Http;
use Tests\Mocks\AwesomeApiMock;
use Tests\TestCase;

class AwesomeApiServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_return_quota_value()
    {

        Http::fake([
            'economia.awesomeapi.com.br/*' => Http::response(AwesomeApiMock::httpReturn(), 200),
        ]);

        $service = new AwesomeApiService();
        $quota = $service->getQuota('EUR', 'BRL');
        $this->assertEquals(6.8327, $quota);
    }

    public function test_should_return_quotaServiceException_when_code_not_200()
    {
        $this->expectException(QuotaServiceException::class);

        Http::fake([
            'economia.awesomeapi.com.br/*' => Http::response(null, 404),
        ]);

        $service = new AwesomeApiService();

        $service->getQuota('EUR', 'BRL');
    }
}
