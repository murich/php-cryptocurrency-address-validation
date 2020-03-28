<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class XRPTest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('XRP');
    }

    public function addressProvider()
    {
        return [
            ['rCoinaUERUrXb1aA7dJu8qRcmvPNiKS3d', true],
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3QJmV3qfvL9SuYo34YihAf3sRCW3qSinyC', false],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
            ['bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq', false],
            ['ltc1qy4rwhdkujk35ga26774gqmng67kgggtqnsx9vp0xgzp3wz3yjkhqashszw', false],
            [1234567, false],
        ];
    }
}