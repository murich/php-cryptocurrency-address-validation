<?php

namespace Murich\PhpCryptocurrencyAddressValidation;

class ValidationFactory
{
    /**
     * @param $currencyCode
     * @param $address
     * @return Murich\PhpCryptocurrencyAddressValidation\Validation\ValidationInterface
     */
    public function build($currencyCode, $address)
    {
        $currencyCode = strtoupper($currencyCode);
        $className = "Murich\\PhpCryptocurrencyAddressValidation\\Validation\\$currencyCode";
        return new $className($address);
    }
}