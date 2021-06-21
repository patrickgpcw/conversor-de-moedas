<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyConverterRequest;
use App\Repositories\API\CurrencyApiConverterRepository;

class CurrencyApiController extends Controller
{
    private $repository;

    public function __construct(CurrencyApiConverterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function converter(CurrencyConverterRequest $request)
    {
        $payload = $request->only([
            'base',
            'to',
            'value',
        ]);

        $data = $this->repository->convert($payload);

        return response()->json($data);
    }
}
