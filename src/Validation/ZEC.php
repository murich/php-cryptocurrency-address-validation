<?php

namespace Murich\PhpCryptocurrencyAddressValidation\Validation;

use Murich\PhpCryptocurrencyAddressValidation\Validation;
use Murich\PhpCryptocurrencyAddressValidation\Validation\ZEC\ZECT;
use Murich\PhpCryptocurrencyAddressValidation\Validation\ZEC\ZECZ;

class ZEC implements ValidationInterface
{
    /** @var  ZECT */
    protected $zect;

    /** @var  ZECZ */
    protected $zecz;

    public function __construct($address)
    {
        $this->zect = new ZECT($address);
        $this->zecz = new ZECZ($address);
    }

    public function validate()
    {
        return $this->zect->validate() || $this->zecz->validate();
    }


}