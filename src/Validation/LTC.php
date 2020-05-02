<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Base58Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Exception;

class LTC extends Base58Validation
{

    const DEPRECATED_ADDRESS_VERSIONS = ['31'];

    protected $deprecatedAllowed = false;

    protected $base58PrefixToHexVersion = [
        'L' => '30',
        'M' => '32',
        '3' => '05'
    ];

    public function validate($address)
    {
        $address = (string)$address;
        $valid = parent::validate($address);

        if (!$valid) {
            // maybe it's a bech32 address
            try {
                $valid = is_array($decoded = Bech32Decoder::decodeRaw($address)) && 'ltc' === $decoded[0];
            } catch (Bech32Exception $exception) {}
        }

        return $valid;
    }

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
