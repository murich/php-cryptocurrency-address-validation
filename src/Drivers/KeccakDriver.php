<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\KeccakDecoder;
use function intval;
use function strtoupper;

class KeccakDriver extends KeccakStrictDriver
{
    public function check(string $address): bool
    {
        $address = $this->toChecksum($address);

        return parent::check($address);
    }

    protected function toChecksum(string $address): string
    {
        $address = str_replace('0x', '', $address);
        $address = mb_strtolower($address);

        $hash = KeccakDecoder::hash($address, 256);

        $checksumAddress = '';
        for ($i = 0; $i < 40; $i++) {
            if (intval($hash[$i], 16) >= 8) {
                $checksumAddress .= strtoupper($address[$i]);
            } else {
                $checksumAddress .= $address[$i];
            }
        }

        return '0x' . $checksumAddress;
    }
}