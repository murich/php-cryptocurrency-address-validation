<?php

namespace Tests;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation\BTC;
use PHPUnit_Framework_TestCase;

class BCHTest extends PHPUnit_Framework_TestCase
{

    public function testValidator()
    {
        $testData = [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', true],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', true],
            ['qrll76p3mfl69p07vyvqzwy3crqy8myvrytgv8v7f7', true],
            ['pruptvpkmxamee0f72sq40gm70wfr624zq0yyxtycm', true],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
        ];

        foreach ($testData as $row) {
            $validator = Validation::make('BCH');
            $this->assertEquals($row[1], $validator->validate($row[0]));
        }

    }
}