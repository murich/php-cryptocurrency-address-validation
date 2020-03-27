<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Exception\CryptocurrencyValidatorNotFound;

abstract class Validation
{
    protected $address;
    protected $addressVersion;
    protected $base58PrefixToHexVersion;
    protected $length  = 50;
    protected $lengths = [];

    protected function __construct()
    {
    }

    public static function make($iso)
    {
        $class = 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\\' . strtoupper($iso);
        if (class_exists($class))
        {
            return new $class();
        }
        throw new CryptocurrencyValidatorNotFound($iso);
    }

    abstract public function validate($address);
}