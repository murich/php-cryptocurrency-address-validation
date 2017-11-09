<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class LTC extends Validation
{

    const DEPRECATED_ADDRESS_VERSIONS = ['31', '05'];

    protected $deprecatedAllowed = false;

    protected $base58PrefixToHexVersion = [
        'L' => '30',
        'M' => '31',
        '3' => '05'
    ];

    protected function validateVersion($version)
    {
        if (!$this->deprecatedAllowed && in_array($this->addressVersion, self::DEPRECATED_ADDRESS_VERSIONS)) {
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
