<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Exception;


class CryptocurrencyValidatorNotFound extends \Exception
{
    public function __construct($iso)
    {
        parent::__construct(sprintf('Cryptocurrency validator for %s not found', $iso));
    }
}