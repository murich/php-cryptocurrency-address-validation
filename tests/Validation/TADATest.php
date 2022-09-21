<?php


namespace Tests\Validation;


use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class TADATest extends BaseValidationTestCase
{

    public function getValidationInstance(): Validation
    {
        return Validation::make('TADA');
    }

    public function addressProvider()
    {
        return [
            ['addr1v8v3auqmw0eszza3ww29ea2pwftuqrqqyu26zvzjq9dt2ncydzvs5', false],
            ['DdzFFzCqrht2KYLcX8Vu53urCG52NxpgrGQvP9Mcp15Q8BkB9df9GndFDBRjoWTPuNkLW3yeQiFVet1KA7mraEkJ84AK2RwcEh3khs12', false],
            ['Ae2tdPwUPEYwNguM7TB3dMnZMfZxn1pjGHyGdjaF4mFqZF9L3bj6cdhiH8t', false],
            ['qrll76p3mfl69p07vyvqzwy3crqy8myvrytgv8v7f7', false],
            ['pruptvpkmxamee0f72sq40gm70wfr624zq0yyxtycm', false],
            ['LbTjMGN7gELw4KbeyQf6cTCq859hD18guE', false],
            ['37btjrVyb4KBbrmcxh3qQzswqDB4SCU8L68vYBJshaeYQ8rHVBfrAfuXZNyFHtR8QXUKR4CtytMyX4DwhsPYKKgFSpq8f5KxNz2s6Guqr6c6LzcHck', true],
            ['2cWKMJemoBaipAW1NGegM2qWevSgpL9baiizayY4NnTBvxRGyppr2uym7F9eEtRLehFek', true],
            ['addr_test1qzfst6x8f4r47vm4qfeuj7g8r5pgkjnv5cuzjk94u8p7sd3gtlpjssk2fy95k4z5lr48tu48fcqstnzte44d8f8v8vhs9pwu4x', true],
        ];
    }
}