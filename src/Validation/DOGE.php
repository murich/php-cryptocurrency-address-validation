<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class DOGE extends Validation
{
    protected $base58PrefixToHexVersion = [
        'D' => '1E',
    ];
}