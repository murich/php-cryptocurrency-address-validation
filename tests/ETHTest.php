<?php

use Murich\PhpCryptocurrencyAddressValidation\Validation\ETH;

class ETHTest extends PHPUnit_Framework_TestCase
{
    public function testValidator()
    {
        $testData = [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', false],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
            ['0x8Fbdce18192e9f917C008411D6e94C9d85a', false],
            ['0x8Fbdce18192e9f917C008411D6e94C9d85a855e20', false],
            ['0x8Fbdce18192e9f917C008411D6e94C9d85a855e2', true],
            ['0x8fbdce18192e9f917c008411d6e94c9d85a855e2', true]
        ];

        foreach ($testData as $row) {
            $validator = new ETH($row[0]);
            $this->assertEquals($row[1], $validator->validate());
        }

    }
}