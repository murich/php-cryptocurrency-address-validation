<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Base58Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\CashAddress;

class BCH extends Base58Validation
{
    // more info at https://en.bitcoin.it/wiki/List_of_address_prefixes
    protected $base58PrefixToHexVersion = [
        '1' => '00',
        '3' => '05'
    ];

    public function validate($address)
    {
        $address = (string)$address;
        try
        {
            $legacy = CashAddress::new2old($address);
        }
        catch (\Exception $ex)
        {
            $legacy = $address;
        }
        return parent::validate($legacy);
    }
}
