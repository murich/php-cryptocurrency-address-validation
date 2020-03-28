<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;
use Tests\TestCase;

abstract class BaseValidationTestCase extends TestCase
{
    public abstract function getValidationInstance() : Validation;
    public abstract function addressProvider();

    /** @dataProvider addressProvider */
    public function testValidate($address, $isValid) {

        $validator = $this->getValidationInstance();
        $this->assertEquals($isValid, $validator->validate($address));
    }
}