<?php

namespace Aamroni\PayPal\Entities;

use Aamroni\PayPal\Interfaces\EntityInterface;

readonly class ProductsEntity implements EntityInterface
{
    /**
     * Define the config data
     * @var array|object
     */
    private array|object $config;

    /**
     * Create a new product entity
     * @param  string|null     $title
     * @param  string|null     $sku
     * @param  int|string|null $quantity
     * @param  int|string|null $regular
     * @param  int|string|null $offered
     * @param  string|null     $details
     * @param  string|null     $currency
     * @return void
     */
    final public function __construct(
        public string|null     $title       = null,
        public string|null     $sku         = null,
        public int|string|null $quantity    = null,
        public int|string|null $regular     = null,
        public int|string|null $offered     = null,
        public string|null     $details     = null,
        public string|null     $currency    = self::DEFAULT_CURRENCY
    ) {
        $this->config = json_decode(json: json_encode(value: config(key: 'payment.paypal')));
    }

    /**
     * Get a static product entity
     * @param  string|null     $title
     * @param  string|null     $sku
     * @param  int|string|null $quantity
     * @param  int|string|null $regular
     * @param  int|string|null $offered
     * @param  string|null     $details
     * @param  string|null     $currency
     * @return static
     */
    public static function instance(
        string|null     $title      = null,
        string|null     $sku        = null,
        int|string|null $quantity   = null,
        int|string|null $regular    = null,
        int|string|null $offered    = null,
        string|null     $details    = null,
        string|null     $currency   = self::DEFAULT_CURRENCY
    ): static {
        return new static($title, $sku, $quantity, $regular, $offered, $details, $currency);
    }

    /**
     * Get the entities resource collection
     * @return array
     */
    public function resource(): array
    {
        return [
            'name'          => $this->title,
            'description'   => $this->details ?? "",
            'quantity'      => (string) $this->quantity,
            'price'         => number_format((int) ($this->regular - $this->offered), 2),
            'tax'           => number_format($this->config->tax_rate, 2),
            'sku'           => $this->sku,
            'currency'      => $this->currency ?? $this->config->currency,
        ];
    }
}
