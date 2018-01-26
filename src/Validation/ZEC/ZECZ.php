<?php

namespace Murich\PhpCryptocurrencyAddressValidation\Validation\ZEC;

use Murich\PhpCryptocurrencyAddressValidation\Validation;

class ZECZ extends Validation
{
    protected $length = 140;

    protected $base58PrefixToHexVersion = [
        'z' => '16'
    ];
}