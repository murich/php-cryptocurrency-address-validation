<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\KeccakDecoder;
use function intval;
use function preg_match;
use function str_split;
use function strtolower;
use function strtoupper;
use function substr;

class KeccakDriver extends AbstractDriver
{
    public function match(string $address): bool
    {
        return preg_match('/^0x[a-fA-F0-9]{40}$/', $address) === 1;
    }

    public function check(string $address): bool
    {
        $address = substr($address, 2);
        $addressHash = KeccakDecoder::hash(strtolower($address), 256);
        $addressArray = str_split($address);
        $addressHashArray = str_split($addressHash);

        for ($i = 0; $i < 40; $i++) {
            // the nth letter should be uppercase if the nth digit of casemap is 1
            if (
                (intval($addressHashArray[$i], 16) > 7 && strtoupper($addressArray[$i]) !== $addressArray[$i]) ||
                (intval($addressHashArray[$i], 16) <= 7 && strtolower($addressArray[$i]) !== $addressArray[$i])
            ) {
                return false;
            }
        }

        return true;
    }
}