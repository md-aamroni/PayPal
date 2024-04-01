<?php

namespace Aamroni\PayPal\Interfaces;

use Aamroni\PayPal\Entities\ProductsEntity;
use Aamroni\PayPal\Entities\PurchaseEntity;
use Aamroni\PayPal\Entities\ShippingEntity;

interface PayPalInterface
{
    /**
     * Process the stripe session checkout
     * @param  string         $invoice
     * @param  ProductsEntity $products
     * @param  PurchaseEntity $purchase
     * @param  ShippingEntity $shipping
     * @return mixed
     */
    public function checkout(string $invoice, ProductsEntity $products, PurchaseEntity $purchase, ShippingEntity $shipping): mixed;
}
