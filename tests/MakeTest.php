<?php


namespace Tests;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class MakeTest extends TestCase
{
    /** @dataProvider makeProvider */
    public function testMake($iso, $class) {
        $instance = Validation::make($iso);

        $this->assertInstanceOf($class, $instance);
    }

    public function makeProvider() {
        return [
            ['BCH', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\BCH'],
            ['BNB', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\BNB'],
            ['BSV', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\BSV'],
            ['BTC', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\BTC'],
            ['DASH', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\DASH'],
            ['DOGE', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\DOGE'],
            ['ETC', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\ETC'],
            ['ETH', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\ETH'],
            ['LTC', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\LTC'],
            ['NEO', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\NEO'],
            ['TBTC', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\TBTC'],
            ['XRP', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\XRP'],
            ['ZEC', 'Merkeleon\PhpCryptocurrencyAddressValidation\Validation\ZEC'],
        ];
    }
}