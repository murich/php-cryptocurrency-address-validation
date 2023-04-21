<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

class EosDriver extends AbstractDriver
{
    public function match(string $address): bool
    {
        return preg_match('/^EOS[1-5a-z]{1}[1-5a-z.]{10,}$/i', $address);
    }

    public function check(string $address): bool
    {
        // Remove the "EOS" prefix from the address
        $prefixRemoved = substr($address, 3);
        // Convert the address to lowercase
        $lowercase = strtolower($prefixRemoved);
        // Take the SHA256 hash of the lowercase address
        $hash = hash('sha256', $lowercase, true);
        // Take the first four bytes of the hash and convert them to hexadecimal
        $hex = bin2hex(substr($hash, 0, 4));

        return substr($address, -4) === $hex;
    }
}
