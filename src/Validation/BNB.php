<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class BNB extends Validation
{
    public function validate($address)
    {
        $valid = false;
        try {
            $valid = is_array($decoded = Bech32Decoder::decodeRaw($address)) && 'bnb' === $decoded[0];
        } catch (Bech32Exception $exception) {}

        return $valid;
    }
}