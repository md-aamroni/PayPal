<?php

namespace Aamroni\PayPal\Facades;

use Aamroni\PayPal\Entities\ProductsEntity;
use Aamroni\PayPal\Entities\PurchaseEntity;
use Aamroni\PayPal\Entities\ShippingEntity;
use Aamroni\PayPal\PayPalPaymentManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection|string|array checkout(string $invoice, ProductsEntity $products, PurchaseEntity $purchase, ShippingEntity $shipping)
 */
class PayPal extends Facade
{
    /**
     * Get a static PayPal facade instance
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return PayPalPaymentManager::class;
    }
}
