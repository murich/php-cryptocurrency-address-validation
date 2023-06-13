<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Drivers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Utils\Bech32Decoder;
use Throwable;
use function array_keys;
use function implode;
use function preg_match;
use function sprintf;

class Bech32Driver extends AbstractDriver
{
    public function match(string $address): bool
    {
        $expr = $this->getPattern();
        return preg_match($expr, $address) === 1;
    }

    public function check(string $address): bool
    {
        try {
            $expr = $this->getPattern();
            preg_match($expr, $address, $match);

            [$hrpGot, $data] = (new Bech32Decoder())->decode($address);
            if ($hrpGot !== $match[2]) {
                return false;
            }

            $dataLen = count($data);

            return !($dataLen === 0 || $dataLen > 65);
        } catch (Throwable) {
            return false;
        }
    }

    private function getPattern(): string
    {
        $prefix = implode('|', array_keys($this->options));
        return sprintf(
            '/^((%s)(0([ac-hj-np-z02-9]{39}|[ac-hj-np-z02-9]{59})|1[ac-hj-np-z02-9]{8,87}))$/',
            $prefix
        );
    }
}