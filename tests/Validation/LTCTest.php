<?php

namespace Tests\Validation;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class LTCTest extends BaseValidationTestCase
{
    public function testLitecoinDeprecatedMultisigAddress()
    {
        $validator = Validation::make('LTC');
        $validator->setDeprecatedAllowed(true);
        $this->assertEquals(true, $validator->validate('3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj'));
    }

    public function getValidationInstance(): Validation
    {
        return Validation::make('LTC');
    }

    public function addressProvider()
    {
        return [
            ['1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp', false],
            ['3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj', true],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', true],
            ['MJRSgZ3UUFcTBTBAaN38XAXvZLwRe8WVw7', true],
            ['ltc1qy4rwhdkujk35ga26774gqmng67kgggtqnsx9vp0xgzp3wz3yjkhqashszw', true],
            ['bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq', false],
        ];
    }
}