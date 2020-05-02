<?php

namespace Tests\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;


class DOGETest extends BaseValidationTestCase
{
    public function getValidationInstance(): Validation
    {
        return Validation::make('DOGE');
    }

    public function addressProvider()
    {
        return [
            ['DDJS1mtpMsFr2SRYf6V4zDHHaZryQngNeP', true],
            ['A5HsGhrcLoYyrbMt9f6rynjupw5DVEaeuy', true],
            ['9rZtSTKzzYhBaDYDXV9q9xkmt1tazHoxNJ', true],
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj', false],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
        ];
    }
}