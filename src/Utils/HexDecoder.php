<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Utils;

use function bcadd;
use function bcdiv;
use function bcmod;
use function bcmul;
use function bcpow;
use function bcsub;
use function dechex;
use function hexdec;
use function str_starts_with;
use function strlen;
use function substr;

class HexDecoder
{
    public static function decode(string $hex): string
    {
        if (str_starts_with($hex, '0x') || str_starts_with($hex, '0X')) {
            $hex = substr($hex, 2);
        }

        $dec = 0;
        $len = strlen($hex);
        for ($i = 1; $i <= $len; $i++) {
            $dec = bcadd($dec, bcmul((string)hexdec($hex[$i - 1]), bcpow('16', (string)($len - $i))));
        }

        return $dec;
    }

    public static function encode(string $dec): string
    {
        $hex = '';
        do {
            $last = (int)bcmod($dec, '16', 8);
            $hex = dechex($last) . $hex;
            $dec = bcdiv(bcsub($dec, (string)$last, 8), '16', 8);
        } while ($dec > 0);

        return $hex;
    }
}