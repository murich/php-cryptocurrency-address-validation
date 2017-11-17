<?php

use Murich\PhpCryptocurrencyAddressValidation\Validation\DGB;

class DGBTest extends PHPUnit_Framework_TestCase
{
    public function testValidator()
    {
        $testData = [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj', false],
            ['DN4yzowAzPbtM6Hh4HsNjFH8QjurZ4Nzhz', true],
            ['DFXMgTmEWL7DB3bXK1DT9neNKUke8F3ksV', true],
        ];

        foreach ($testData as $row) {
            $validator = new DGB($row[0]);
            $this->assertEquals($row[1], $validator->validate());
        }

    }
}