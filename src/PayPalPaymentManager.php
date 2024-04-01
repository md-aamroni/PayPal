<?php

namespace Aamroni\PayPal;

use Aamroni\PayPal\Adapters\PaymentAdapter;
use Aamroni\PayPal\Contracts\ApiPaymentContract;
use Aamroni\PayPal\Contracts\OAuthTokenContract;
use Aamroni\PayPal\Entities\ProductsEntity;
use Aamroni\PayPal\Entities\PurchaseEntity;
use Aamroni\PayPal\Entities\ShippingEntity;
use Aamroni\PayPal\Exceptions\PayPalPaymentException;
use Illuminate\Support\Collection;
use Throwable;

readonly class PayPalPaymentManager extends PaymentAdapter
{
    public function process(string $invoice, ProductsEntity $products, PurchaseEntity $purchase, ShippingEntity $shipping): Collection|string|array
    {
        dd($shipping, $purchase, $products, $invoice);
    }

    /**
     * Process the stripe session checkout
     * @param  string                  $invoice
     * @param  ProductsEntity          $products
     * @param  PurchaseEntity          $purchase
     * @param  ShippingEntity          $shipping
     * @return Collection|string|array
     */
    public function checkout(string $invoice, ProductsEntity $products, PurchaseEntity $purchase, ShippingEntity $shipping): Collection|string|array
    {
        try {
            $instance = OAuthTokenContract::instance()->process();
            if (empty($instance) && (!is_array($instance) || !is_object($instance))) {
                throw new PayPalPaymentException();
            }
            $resource = $this->payload(invoice: $invoice, products: $products, purchase: $purchase, shipping: $shipping);
            return ApiPaymentContract::instance()->process(access: $instance['access_token'], payload: $resource);
        } catch (Throwable $exception) {
            return $exception->getMessage();
        }
    }
}
