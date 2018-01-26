<?php

namespace Murich\PhpCryptocurrencyAddressValidation\Validation;

use Murich\PhpCryptocurrencyAddressValidation\Validation;

class ETH implements ValidationInterface
{
    protected $address;

    public function __construct($address)
    {
        $this->address = $address;
    }

    public function validate()
    {
        return preg_match('/^(0x)?[0-9a-f]{40}$/i', $this->address);
    }

}