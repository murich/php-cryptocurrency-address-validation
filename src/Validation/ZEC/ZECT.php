<?php

namespace Murich\PhpCryptocurrencyAddressValidation\Validation\ZEC;

use Murich\PhpCryptocurrencyAddressValidation\Validation;

class ZECT extends Validation
{
    protected $length = 52;

    protected $base58PrefixToHexVersion = [
        't' => '1C'
    ];
}