<?php

namespace Aamroni\PayPal\Entities;

use Aamroni\PayPal\Interfaces\EntityInterface;

readonly class PurchaseEntity implements EntityInterface
{
    /**
     * Define the config data
     * @var array|object
     */
    private array|object $config;

    /**
     * Create a new purchase entity
     * @param  int|float|null $total
     * @param  string|null    $currency
     * @return void
     */
    final public function __construct(
        public int|float|null $total        = 0,
        public string|null    $currency     = self::DEFAULT_CURRENCY,
    ) {
        $this->config = json_decode(json: json_encode(value: config(key: 'payment.paypal')));
    }

    /**
     * Get a static purchase entity
     * @param  int|float|null $total
     * @param  string|null    $currency
     * @return static
     */
    public static function instance(
        int|float|null $total       = 0,
        string|null    $currency    = self::DEFAULT_CURRENCY
    ): static {
        return new static($total, $currency);
    }

    /**
     * Get the entities resource collection
     * @return array
     */
    public function resource(): array
    {
        return [
            'total'     => number_format($this->total, 2),
            'currency'  => $this->currency ?? $this->config->currency,
            'details'   => [
                'subtotal'          => number_format(($this->total + $this->config->tax_rate + $this->config->shipping->netPrice + $this->config->additional + $this->config->insurance) - $this->config->shipping->discount, 2),
                'tax'               => number_format($this->config->tax_rate, 2),
                'shipping'          => number_format($this->config->shipping->netPrice, 2),
                'handling_fee'      => number_format($this->config->additional, 2),
                'shipping_discount' => number_format($this->config->shipping->discount, 2),
                'insurance'         => number_format($this->config->insurance, 2)
            ]
        ];
    }
}
