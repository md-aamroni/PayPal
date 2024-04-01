<?php

namespace Aamroni\PayPal\Entities;

use Aamroni\PayPal\Interfaces\EntityInterface;

readonly class ShippingEntity implements EntityInterface
{
    /**
     * Create a new shipping entity
     * @param  string|null $name
     * @param  string|null $mobile
     * @param  string|null $street1
     * @param  string|null $street2
     * @param  string|null $city
     * @param  string|null $postal
     * @param  string|null $state
     * @param  string|null $country
     * @return void
     */
    final public function __construct(
        public string|null $name    = null,
        public string|null $mobile  = null,
        public string|null $street1 = null,
        public string|null $street2 = null,
        public string|null $city    = null,
        public string|null $postal  = null,
        public string|null $state   = null,
        public string|null $country = null
    ) {
        // TODO: Skip Code Here...
    }

    /**
     * Get a static shipping entity
     * @param  string|null $name
     * @param  string|null $mobile
     * @param  string|null $street1
     * @param  string|null $street2
     * @param  string|null $city
     * @param  string|null $postal
     * @param  string|null $state
     * @param  string|null $country
     * @return static
     */
    public static function instance(
        string|null $name       = null,
        string|null $mobile     = null,
        string|null $street1    = null,
        string|null $street2    = null,
        string|null $city       = null,
        string|null $postal     = null,
        string|null $state      = null,
        string|null $country    = null
    ): static {
        return new static($name, $mobile, $street1, $street2, $city, $postal, $state, $country);
    }

    /**
     * Get the entities resource collection
     * @return array
     */
    public function resource(): array
    {
        return [
            'recipient_name'    => $this->name,
            'line1'             => $this->street1,
            'line2'             => $this->street2,
            'city'              => $this->city,
            'country_code'      => $this->country,
            'postal_code'       => $this->postal,
            'phone'             => $this->mobile,
            'state'             => $this->state
        ];
    }
}
