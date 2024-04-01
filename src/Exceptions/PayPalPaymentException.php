<?php

namespace Aamroni\PayPal\Exceptions;

use Exception;

class PayPalPaymentException extends Exception
{
    /**
     * The error message
     * @var string
     */
    protected $message = 'An error occurred during paypal payment';
}
