<?php

namespace Murich\PhpCryptocurrencyAddressValidation\Validation;

use Murich\PhpCryptocurrencyAddressValidation\Validation;

class BTC extends Validation
{
    // more info at https://en.bitcoin.it/wiki/List_of_address_prefixes
    protected $addressVersionByFirstChar = [
        '1' => '00',
        '3' => '05'
    ];
}