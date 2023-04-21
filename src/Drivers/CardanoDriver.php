<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Exception\Bech32Exception;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use function array_keys;
use function implode;
use function in_array;
use function preg_match;

class CardanoDriver extends AbstractDriver
{

    public function match(string $address): bool
    {
        $prefix =  implode('|', array_keys($this->options));
        $expr = sprintf('/^(%s)[0-9a-z]{38,}$/', $prefix);

        return preg_match($expr, $address) === 1;
    }

    public function check(string $address): bool
    {
        try {
            $decoded = (new Bech32Decoder())->decode($address);

            return in_array(array_keys($this->options), $decoded[0], true);
        } catch (Bech32Exception) {
            return false;
        }
    }
}