<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class TRXTest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('TRX');
    }

    public function addressProvider()
    {
        return [
            ['TF5Bn4cJCT6GVeUgyCN4rBhDg42KBrpAjg', true],
            ['TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t', true],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', false],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
            ['bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq', false],
        ];
    }
}