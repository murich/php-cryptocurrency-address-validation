<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Contracts;

interface Driver
{
    public function match(string $address): bool;
    public function check(string $address): bool;
}