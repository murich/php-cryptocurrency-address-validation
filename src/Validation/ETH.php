<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Sha3;
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class ETH extends Validation
{
    public function isAddress($address)
    {
        if (preg_match('/^(0x)[0-9a-f]{40}$/i', $address))
        {
            //TODO: fix sha3, and remove this hack
            return true;
        }

        if (!preg_match('/^(0x)[0-9a-f]{40}$/i', $address))
        {
            // check if it has the basic requirements of an address
            return false;
        }
        elseif (!preg_match('/^(0x)[0-9a-f]{40}$/', $address) || preg_match('/^(0x)[0-9A-F]{40}$/', $address))
        {
            // If it's all small caps or all all caps, return true
            return true;
        }
        else
        {
            // Otherwise check each case
            return $this->isChecksumAddress($address);
        }
    }

    public function isChecksumAddress($address)
    {
        // Check each case
        $address          = str_replace('0x', '', $address);
        $addressHash      = Sha3::hash(strtolower($address), 256);
        $addressArray     = str_split($address);
        $addressHashArray = str_split($addressHash);

        for ($i = 0; $i < 40; $i++)
        {
            // the nth letter should be uppercase if the nth digit of casemap is 1
            if ((intval($addressHashArray[$i], 16) > 7 && strtoupper($addressArray[$i]) !== $addressArray[$i]) || (intval($addressHashArray[$i], 16) <= 7 && strtolower($addressArray[$i]) !== $addressArray[$i]))
            {
                return false;
            }
        }

        return true;
    }

    public function validate($address)
    {
        return $this->isAddress($address);
    }
}