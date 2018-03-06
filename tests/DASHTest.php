<?php

namespace Tests;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation\DASH;
use PHPUnit_Framework_TestCase;

class DASHTest extends PHPUnit_Framework_TestCase
{
    public function testValidator()
    {

        $testData = [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj', false],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
            ['Xaj4r3cuJ5LYbrQgZTSQAhneJnjybAAgEN', true],
            ['7SSyVfQK3EbQrmPy7b3j4DKk9vWh7yXZ7R', true],
            ['7STE7NqFACug51jj3h8VqWjCPrePuBw5Q5', true],
            ['7STKNHrd8UgSySdqwrsjCWK9wdcJH7D9jp', true],
            ['7SUvPX3PaXHxwgHF6VnFAnzHiySHbfTmWV', true],
            ['7SWtdwZDy1Ff5L5EZJkb3Fv1nat2e9qXq5', true],
        ];

        foreach ($testData as $row) {
            $validator = Validation::make('DASH');
            $this->assertEquals($row[1], $validator->validate($row[0]));
        }

    }
}