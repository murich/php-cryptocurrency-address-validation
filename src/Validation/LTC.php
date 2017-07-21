<?php

namespace Murich\PhpCryptocurrencyAddressValidation\Validation;

use Murich\PhpCryptocurrencyAddressValidation\AddressVersions;
use Murich\PhpCryptocurrencyAddressValidation\Validation;

class LTC extends Validation
{
    const DEPRECATED_ADDRESS_VERSION = '05';

    protected $deprecatedAllowed = false;

    protected $addressVersionByFirstChar = [
        'L' => '30',
        'M' => '31',
        '3' => self::DEPRECATED_ADDRESS_VERSION // deprecated for litecoin, should not be allowed for new user's inputs
    ];

    protected function validateVersion($version)
    {
        if ($this->addressVersion == self::DEPRECATED_ADDRESS_VERSION && !$this->deprecatedAllowed) {
            return false;
        }
        return hexdec($version) == hexdec($this->addressVersion);
    }

    /**
     * @return boolean
     */
    public function isDeprecatedAllowed()
    {
        return $this->deprecatedAllowed;
    }

    /**
     * @param boolean $deprecatedAllowed
     */
    public function setDeprecatedAllowed($deprecatedAllowed)
    {
        $this->deprecatedAllowed = $deprecatedAllowed;
    }

}