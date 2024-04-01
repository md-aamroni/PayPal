<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Payment Payment Config
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache store that will be used by the
    | framework. This connection is utilized if another isn't explicitly
    | specified when running a cache operation inside the application.
    |
    */
    'paypal' => [
        'client'        => env('PAYPAL_CLIENT_KEY'),
        'secret'        => env('PAYPAL_SECRET_KEY'),
        'redirect'      => [
            'success'   => sprintf('%s/paypal/success', env('APP_URL')),
            'cancel'    => sprintf('%s/paypal/cancel', env('APP_URL')),
        ],
        'currency'      => 'USD',
        'tax_rate'      => 0,
        'insurance'     => 0,
        'additional'    => 0,
        'shipping'      => [
            'discount'  => 0,
            'netPrice'  => 0
        ]
    ],
];
