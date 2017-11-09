<?php

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation\BTC;

class BTCTest extends PHPUnit_Framework_TestCase
{

    public function testValidator()
    {
        $testData = [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', true],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', true],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false]
        ];

        foreach ($testData as $row) {
            $validator = new BTC($row[0]);
            $this->assertEquals($row[1], $validator->validate());
        }

    }
}