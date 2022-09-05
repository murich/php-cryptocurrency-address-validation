<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class TBCHTest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('TBCH');
    }

    public function addressProvider()
    {
        return [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', false],
            ['bchtest:qzh3ztgfjv98fxz8grmfd5fhjw35dwyzry56cytlcf', true],
            ['bchtest:qqtzysu48d6sw9w93ly992al535gj9lejvjtz7n2j3', true],
            ['bchtest:qq90c9zgafuasslctr5835jxdz8pxayh5qcl9r8cdz', true],
            ['mwUd82cnzriFf6P9NLEfwhzeh3KECDGjq4', true],
            ['mhXzCyhnhLVA7b6M7Krgff4gwTTowA7Xe5', true],
            ['mgX32k9nonkLGvBFAQstjGDtgLvv4dyrM2', true],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
        ];
    }
}