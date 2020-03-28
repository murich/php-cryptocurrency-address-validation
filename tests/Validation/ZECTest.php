<?php

namespace Tests\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation\BTC;
use PHPUnit\Framework\TestCase;

class ZECTest extends BaseValidationTestCase
{
    public function getValidationInstance(): Validation
    {
        return Validation::make('ZEC');
    }

    public function addressProvider()
    {
        return [
            ['t1ZJQNuop1oytQ7ow4Kq8o9if3astavba5W', true],
            ['t3Vz22vK5z2LcKEdg16Yv4FFneEL1zg9ojd', true],
            ['zcBqWB8VDjVER7uLKb4oHp2v54v2a1jKd9o4FY7mdgQ3gDfG8MiZLvdQga8JK3t58yjXGjQHzMzkGUxSguSs6ZzqpgTNiZG', false],
        ];
    }
}