<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Base58Decoder;
use function array_keys;
use function hash;
use function implode;
use function pack;
use function preg_match;
use function sprintf;
use function strtolower;
use function strtoupper;
use function substr;

abstract class Base58Driver extends AbstractDriver
{
    public function match(string $address): bool
    {
        $prefix =  implode('|', array_keys($this->options));
        $expr = sprintf('/^(%s)[a-km-zA-HJ-NP-Z1-9]{25,34}$/', $prefix);

        return preg_match($expr, $address) === 1;
    }

    protected function getVersion($address): ?string
    {
        $hexString = Base58Decoder::decode($address, static::$base58Alphabet);
        if (!$hexString) {
            return null;
        }

        $version = substr($hexString, 0, 2);

        $check = substr($hexString, 0, -8);
        $check = pack("H*", $check);
        $check = hash("sha256", $check, true);
        $check = hash("sha256", $check);
        $check = strtoupper($check);
        $check = substr($check, 0, 8);

        $isValid = str_ends_with($hexString, strtolower($check));

        return $isValid ? $version : null;
    }
}