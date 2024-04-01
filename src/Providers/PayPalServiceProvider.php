<?php

namespace Aamroni\PayPal\Providers;

use Aamroni\PayPal\Facades\PayPal;
use Aamroni\PayPal\PayPalPaymentManager;
use Illuminate\Support\ServiceProvider;

class PayPalServiceProvider extends ServiceProvider
{
    /**
     * Register stripe payment services
     * @return void
     */
    public function register(): void
    {
        // @todo: bind the base class
        $this->app->bind(abstract: PayPal::class, concrete: PayPalPaymentManager::class);

        // @todo: merge the config file
        $this->mergeConfigFrom(path: __DIR__ . '/../../config/payment.php', key: 'payment');
    }

    /**
     * Bootstrap stripe payment services
     * @return void
     */
    public function boot(): void
    {
        // @todo: publish the config file
        $this->publishes(paths: [
            __DIR__ . '/../../config/payment.php' => config_path(path: 'payment.php'),
        ], groups: 'aamroni-payment');
    }
}
