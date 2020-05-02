<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class BNBTest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('BNB');
    }

    public function addressProvider()
    {
        return [
            ['bnb136ns6lfw4zs5hg4n85vdthaad7hq5m4gtkgf23', true],
            ['bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq', false],
            ['0xea674fdde714fd979de3edf0f56aa9716b898ec8', false],
        ];
    }
}