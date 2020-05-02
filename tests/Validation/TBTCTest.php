<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class TBTCTest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('TBTC');
    }

    public function addressProvider()
    {
        return [
            ['mipcBbFg9gMiCh81Kj8tqqdgoZub1ZJRfn', true],
            ['2MzQwSSnBHWHqSAqtTVQ6v47XtaisrJa1Vc', true],
            ['tb1qw508d6qejxtdg4y5r3zarvary0c5xw7kxpjzsx', true],
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', false],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
            ['bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq', false],

        ];
    }
}