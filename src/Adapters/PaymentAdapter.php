<?php

namespace Aamroni\PayPal\Adapters;

use Aamroni\PayPal\Entities\ProductsEntity;
use Aamroni\PayPal\Entities\PurchaseEntity;
use Aamroni\PayPal\Entities\ShippingEntity;
use Aamroni\PayPal\Interfaces\PayPalInterface;

abstract readonly class PaymentAdapter extends ForFendAdapter implements PayPalInterface
{
    /**
     * Define the config
     * @var array|object|mixed
     */
    protected array|object $config;

    /**
     * Create a new PayPal instance
     * @return void
     */
    final public function __construct()
    {
        $this->config = json_decode(json: json_encode(value: config(key: 'payment.paypal')));
    }

    /**
     * Get a static PayPal instance
     * @return static
     */
    public static function instance(): static
    {
        return new static();
    }

    protected function payload(string $invoice, ProductsEntity $products, PurchaseEntity $purchase, ShippingEntity $shipping): array
    {
        return [
            'intent'        => 'sale',
            'payer'         => ['payment_method' => 'paypal'],
            'transactions'  => [
                [
                    'amount'            => $purchase->resource(),
                    'description'       => 'This payment transaction is checkout from GuidEasy',
                    'invoice_number'    => $invoice,
                    'payment_options'   => ['allowed_payment_method' => 'INSTANT_FUNDING_SOURCE'],
                    'item_list'         => [
                        'items'             => [
                            $products->resource()
                        ],
                        'shipping_address'  => $shipping->resource()
                    ]
                ]
            ],
            'note_to_payer' => 'Contact us for any questions on your order.',
            'redirect_urls' => [
                'return_url'    => $this->config->redirect->success,
                'cancel_url'    => $this->config->redirect->cancel
            ]
        ];
    }
}
