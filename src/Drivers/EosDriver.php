<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

class EosDriver extends AbstractDriver
{
    public function match(string $address): bool
    {
        return preg_match('/(^[a-z1-5.]{1,11}[a-z1-5]$)|(^[a-z1-5.]{12}[a-j1-5]$)/', $address) === 1;
    }

    public function check(string $address): bool
    {
        return true;
    }
}
