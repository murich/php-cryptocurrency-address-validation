<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

use function array_keys;
use function implode;
use function preg_match;
use function sprintf;

class XrpXAddressDriver extends XrpBase58Driver
{
    public function match(string $address): bool
    {
        $prefix = implode('|', array_keys($this->options));
        $expr = sprintf('/^(%s)[a-km-zA-HJ-NP-Z1-9]{33,55}$/', $prefix);

        return preg_match($expr, $address) === 1;
    }

    public function check(string $address): bool
    {
        return true;
    }
}
