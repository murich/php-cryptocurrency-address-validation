<?php

namespace Murich\PhpCryptocurrencyAddressValidation\Validation;

interface ValidationInterface
{
    public function __construct($address);

    /**  @return bool */
    public function validate();
}