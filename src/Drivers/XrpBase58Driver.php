<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

class XrpBase58Driver extends Base58Driver
{
    protected static string $base58Alphabet = 'rpshnaf39wBUDNEGHJKLM4PQRST7VWXYZ2bcdeCg65jkm8oFqi1tuvAxyz';

    public function check(string $address): bool
    {
        return $this->getVersion($address) !== null;
    }
}
