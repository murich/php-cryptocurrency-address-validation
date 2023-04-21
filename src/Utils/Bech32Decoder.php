<?php

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Utils;

use Merkeleon\PhpCryptocurrencyAddressValidation\Exception\Bech32Exception;
use RuntimeException;
use function array_merge;
use function array_slice;
use function array_values;
use function ord;
use function pack;
use function strlen;
use function unpack;

/**
 * @see https://github.com/Bit-Wasp/bech32/blob/master/src/bech32.php
 */
class Bech32Decoder
{
    public const GENERATOR = [0x3b6a57b2, 0x26508e6d, 0x1ea119fa, 0x3d4233dd, 0x2a1462b3];
    public const CHARKEY_KEY = [
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
        15, -1, 10, 17, 21, 20, 26, 30,  7,  5, -1, -1, -1, -1, -1, -1,
        -1, 29, -1, 24, 13, 25,  9,  8, 23, -1, 18, 22, 31, 27, 19, -1,
        1,  0,  3, 16, 11, 28, 12, 14,  6,  4,  2, -1, -1, -1, -1, -1,
        -1, 29, -1, 24, 13, 25,  9,  8, 23, -1, 18, 22, 31, 27, 19, -1,
        1,  0,  3, 16, 11, 28, 12, 14,  6,  4,  2, -1, -1, -1, -1, -1
    ];

    /**
     * Validates a bech32 string and returns [$hrp, $dataChars] if
     * the conversion was successful. An exception is thrown on invalid
     * data.
     *
     * @param string $sBech The bech32 encoded string
     *
     * @return array Returns [$hrp, $dataChars]
     *
     * @throws Bech32Exception
     */
    public function decode(string $sBech): array
    {
        $length = strlen($sBech);

        if ($length > 90) {
            throw new Bech32Exception('Bech32 string cannot exceed 90 characters in length');
        }

        return $this->decodeRaw($sBech);
    }

    /**
     * @param string $sBech The bech32 encoded string
     *
     * @return array Returns [$hrp, $dataChars]
     * @throws Bech32Exception
     * @throws Bech32Exception
     */
    public function decodeRaw(string $sBech): array
    {
        $length = strlen($sBech);

        if ($length < 8) {
            throw new Bech32Exception("Bech32 string is too short");
        }

        $chars = array_values(unpack('C*', $sBech));

        $haveUpper = false;
        $haveLower = false;
        $positionOne = -1;

        for ($i = 0; $i < $length; $i++) {
            $x = $chars[$i];

            if ($x < 33 || $x > 126) {
                throw new Bech32Exception('Out of range character in bech32 string');
            }

            if ($x >= 0x61 && $x <= 0x7a) {
                $haveLower = true;
            }

            if ($x >= 0x41 && $x <= 0x5a) {
                $haveUpper = true;
                $x = $chars[$i] = $x + 0x20;
            }

            // find location of last '1' character
            if ($x === 0x31) {
                $positionOne = $i;
            }
        }

        if ($haveUpper && $haveLower) {
            throw new Bech32Exception('Data contains mixture of higher/lower case characters');
        }

        if ($positionOne === -1) {
            throw new Bech32Exception("Missing separator character");
        }

        if ($positionOne < 1) {
            throw new Bech32Exception("Empty HRP");
        }

        if (($positionOne + 7) > $length) {
            throw new Bech32Exception('Too short checksum');
        }

        $hrp = pack("C*", ...array_slice($chars, 0, $positionOne));

        $data = [];

        for ($i = $positionOne + 1; $i < $length; $i++) {
            $data[] = ($chars[$i] & 0x80) ? -1 : self::CHARKEY_KEY[$chars[$i]];
        }

        if (!$this->verifyChecksum($hrp, $data)) {
            throw new Bech32Exception('Invalid bech32 checksum');
        }

        return [$hrp, array_slice($data, 0, -6)];
    }

    /**
     * Verifies the checksum given $hrp and $convertedDataChars.
     *
     * @param string $hrp
     * @param int[]  $convertedDataChars
     *
     * @return bool
     */
    private function verifyChecksum(string $hrp, array $convertedDataChars): bool
    {
        $expandHrp = $this->hrpExpand($hrp, strlen($hrp));
        $r = array_merge($expandHrp, $convertedDataChars);
        $poly = $this->polyMod($r, count($r));

        return $poly === 1;
    }


    /**
     * Expands the human-readable part into a character array for checksumming.
     *
     * @param string $hrp
     * @param int $hrpLen
     * @return int[]
     */
    private function hrpExpand(string $hrp, int $hrpLen): array
    {
        $expand1 = [];
        $expand2 = [];

        for ($i = 0; $i < $hrpLen; $i++) {
            $o = ord($hrp[$i]);
            $expand1[] = $o >> 5;
            $expand2[] = $o & 31;
        }

        return array_merge($expand1, [0], $expand2);
    }

    /**
     * @param int[] $values
     * @param int $numValues
     *
     * @return int
     */
    private function polyMod(array $values, int $numValues): int
    {
        $chk = 1;
        for ($i = 0; $i < $numValues; $i++) {
            $top = $chk >> 25;
            $chk = ($chk & 0x1ffffff) << 5 ^ $values[$i];

            for ($j = 0; $j < 5; $j++) {
                $value = (($top >> $j) & 1) ? self::GENERATOR[$j] : 0;
                $chk ^= $value;
            }
        }

        return $chk;
    }

    /**
     * Converts words of $fromBits bits to $toBits bits in size.
     *
     * @param int[] $data Character array of data to convert
     * @param int $inLen Number of elements in array
     * @param int $fromBits Word (bit count) size of provided data
     * @param int $toBits Requested word size (bit count)
     * @param bool $pad Whether to pad (only when encoding)
     *
     * @return int[]
     *
     * @throws Bech32Exception
     */
    private function convertBits(array $data, int $inLen, int $fromBits, int $toBits, bool $pad = true): array
    {
        $acc = 0;
        $bits = 0;
        $ret = [];
        $maxv = (1 << $toBits) - 1;
        $maxacc = (1 << ($fromBits + $toBits - 1)) - 1;

        for ($i = 0; $i < $inLen; $i++) {
            $value = $data[$i];

            if ($value < 0 || $value >> $fromBits) {
                throw new Bech32Exception('Invalid value for convert bits');
            }

            $acc = (($acc << $fromBits) | $value) & $maxacc;
            $bits += $fromBits;

            while ($bits >= $toBits) {
                $bits -= $toBits;
                $ret[] = (($acc >> $bits) & $maxv);
            }
        }

        if ($pad && $bits) {
            $ret[] = ($acc << $toBits - $bits) & $maxv;
        } elseif ($bits >= $fromBits || ((($acc << ($toBits - $bits))) & $maxv)) {
            throw new Bech32Exception('Invalid data');
        }

        return $ret;
    }


    /**
     * @param int $version
     *
     * @param string $program
     *
     * @throws RuntimeException
     */
    private function validateWitnessProgram(int $version, string $program): void
    {
        if ($version < 0 || $version > 16) {
            throw new RuntimeException("Invalid witness version");
        }

        $sizeProgram = strlen($program);
        if (($version === 0) && $sizeProgram !== 20 && $sizeProgram !== 32) {
            throw new RuntimeException("Invalid size for V0 witness program");
        }

        if ($sizeProgram < 2 || $sizeProgram > 40) {
            throw new RuntimeException("Witness program size was out of valid range");
        }
    }
}