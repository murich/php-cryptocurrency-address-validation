<?php

namespace Tests\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;


class ETCTest extends BaseValidationTestCase
{
    public function getValidationInstance(): Validation
    {
        return Validation::make('ETC');
    }

    public function addressProvider()
    {
        return [
            ['0x05a56e2d52c817161883f50c441c3228cfe54d9f', true],
            ['05a56e2d52c817161883f50c441c3228cfe54d9f', false],
        ];
    }
}