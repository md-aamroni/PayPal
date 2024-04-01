<?php

namespace Aamroni\PayPal\Contracts;

use Aamroni\PayPal\Adapters\HttpReqAdapter;
use Aamroni\PayPal\Supports\HttpRequestHandler;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

readonly class OAuthTokenContract extends HttpReqAdapter
{
    /**
     * Inherited class must be extended
     * @return Collection|array
     */
    public function process(): Collection|array
    {
        $response = Http::withBasicAuth(username: env(key: 'PAYPAL_CLIENT'), password: env(key: 'PAYPAL_SECRET'))
            ->withHeaders(headers: ['Content-Type' => 'application/x-www-form-urlencoded'])
            ->asForm()
            ->post(url: 'https://api-m.sandbox.paypal.com/v1/oauth2/token', data: [
                'grant_type' => 'client_credentials'
            ]);
        return HttpRequestHandler::instance($response)->process();
    }
}
