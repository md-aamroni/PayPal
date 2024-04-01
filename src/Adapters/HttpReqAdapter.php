<?php

namespace Aamroni\PayPal\Adapters;

abstract readonly class HttpReqAdapter extends ForFendAdapter
{
    /**
     * Create a new Stripe instance
     * @return void
     */
    final public function __construct()
    {
        // TODO: Your Code Here...
    }

    /**
     * Get a static Stripe instance
     * @return static
     */
    public static function instance(): static
    {
        return new static();
    }

    /**
     * Inherited class must be extended
     * @return mixed
     */
    abstract public function process(): mixed;
}
