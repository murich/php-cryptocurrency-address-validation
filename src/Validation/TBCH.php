<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Base58Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\CashAddress;

class TBCH extends Base58Validation
{
    // more info at https://en.bitcoin.it/wiki/List_of_address_prefixes
    protected $base58PrefixToHexVersion = [
        'm' => '6F',
        'n' => '6F',
        '2' => 'C4'
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
