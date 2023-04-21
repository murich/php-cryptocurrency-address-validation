<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Exception;

use Merkeleon\PhpCryptocurrencyAddressValidation\Contracts\Options;

class AddressValidationException extends \RuntimeException
{
    public function __construct(string $chain, string $notValidAddress)
    {
        parent::__construct("Incorrect {$chain} address [{$notValidAddress}]");
    }
}