<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class DOGE extends Validation
{

    public function validate($address)
    {
        $address = hex2bin(self::base58ToHex($address));
        if (strlen($address) !== 25)
        {
            return false;
        }
        $checksum   = substr($address, 21, 4);
        $rawAddress = substr($address, 0, 21);
        if (substr(hex2bin(hash('sha256', hex2bin(hash('sha256', $rawAddress)))), 0, 4) === $checksum)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}