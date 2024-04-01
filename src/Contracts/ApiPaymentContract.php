<?php

namespace Aamroni\PayPal\Contracts;

use Aamroni\PayPal\Adapters\HttpReqAdapter;
use Aamroni\PayPal\Supports\HttpRequestHandler;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

readonly class ApiPaymentContract extends HttpReqAdapter
{
    /**
     * Inherited class must be extended
     * @param  string|null      $access
     * @param  array|null       $payload
     * @return Collection|array
     */
    public function process(?string $access = null, ?array $payload = []): Collection|array
    {
        $response = Http::withToken(token: $access)
            ->withHeaders(headers: ['Content-Type' => 'application/json'])
            ->asJson()
            ->post(url: 'https://api-m.sandbox.paypal.com/v1/payments/payment', data: $payload);
        return HttpRequestHandler::instance($response)->process();
    }
}
