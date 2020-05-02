<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class BCHTest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('BCH');
    }

    public function addressProvider()
    {
        return [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', true],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', true],
            ['qrll76p3mfl69p07vyvqzwy3crqy8myvrytgv8v7f7', true],
            ['pruptvpkmxamee0f72sq40gm70wfr624zq0yyxtycm', true],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
        ];
    }
}