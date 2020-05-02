<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class BTCTest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('BTC');
    }

    public function addressProvider()
    {
        return [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', true],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', true],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
            ['bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq', true],
            ['ltc1qy4rwhdkujk35ga26774gqmng67kgggtqnsx9vp0xgzp3wz3yjkhqashszw', false],
            ['mipcBbFg9gMiCh81Kj8tqqdgoZub1ZJRfn', false],
            ['2MzQwSSnBHWHqSAqtTVQ6v47XtaisrJa1Vc', false],
            ['tb1qw508d6qejxtdg4y5r3zarvary0c5xw7kxpjzsx', false],
        ];
    }
}