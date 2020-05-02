<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class NEOTest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('NEO');
    }

    public function addressProvider()
    {
        return [
            ['AXaXZjZGA3qhQRTCsyG5uFKr9HeShgVhTF', true],
            ['AXaXZjZGA3qhQRTCsyG5uFKr9HeShgVhTg', false],
        ];
    }
}