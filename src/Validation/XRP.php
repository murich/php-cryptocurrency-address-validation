<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Base58Validation;

class XRP extends Base58Validation
{
    protected static $base58Dictionary = 'rpshnaf39wBUDNEGHJKLM4PQRST7VWXYZ2bcdeCg65jkm8oFqi1tuvAxyz';

    public function validate($address)
    {
        $address = (string)$address;
        $hexAddress = static::base58ToHex($address);
        $check = substr($hexAddress, 0, strlen($hexAddress) - 8);
        $check = pack("H*", $check);
        $check = strtoupper(hash("sha256", hash("sha256", $check, true)));
        $check = substr($check, 0, 8);
        return $check == substr($hexAddress, strlen($hexAddress) - 8);
    }

}
