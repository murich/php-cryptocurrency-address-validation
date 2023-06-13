<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Contracts\Driver;

abstract class AbstractDriver implements Driver
{
    public function __construct(protected readonly array $options)
    {
    }
}