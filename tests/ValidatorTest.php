<?php

declare(strict_types=1);

namespace Tests;

use Merkeleon\PhpCryptocurrencyAddressValidation\Enums\CurrencyEnum;
use Merkeleon\PhpCryptocurrencyAddressValidation\Validator;

/**
 * @coversDefaultClass \Merkeleon\PhpCryptocurrencyAddressValidation\Validator
 */
class ValidatorTest extends TestCase
{
    /**
     * @covers ::isValid
     * @dataProvider currencyAddressProvider
     *
     * @param CurrencyEnum $currency
     * @param string       $net
     * @param bool         $expected
     * @param string       $address
     *
     * @return void
     */
    public function test_currency_validator(CurrencyEnum $currency, string $net, bool $expected, string $address): void
    {
        $config = require __DIR__ . '/../config/address_validation.php';

        $options = $config[$currency->value];

        $validator = new Validator($currency->value, $options, $net === 'mainnet');

        $this->assertEquals(
            $expected,
            $validator->isValid($address),
            "[{$currency->value}] address [{$address}] is invalid"
        );
    }

    public function currencyAddressProvider(): array
    {
        return [
            'Beacon #1' => [CurrencyEnum::BEACON, 'mainnet', true, 'bnb1fnd0k5l4p3ck2j9x9dp36chk059w977pszdgdz'],
            'Beacon #2' => [CurrencyEnum::BEACON, 'mainnet', true, 'bnb1xd8cn4w7q4hm4fc9a68xtpx22kqenju7ea8d3v'],
            'Beacon #3' => [CurrencyEnum::BEACON, 'testnet', true, 'tbnb1nuxna8asq69jf05cldcxpx9ee0m7drd9qz3aru'],
            'Beacon #4' => [CurrencyEnum::BEACON, 'mainnet', false, 'bnb1nuxna8asq69jf05cldcxpx9ee0m7drd9qz3aru'],
            'Beacon #5' => [CurrencyEnum::BEACON, 'testnet', false, 'bnb1nuxna8asq69jf05cldcxpx9ee0m7drd9qz3aru'],
            //
            'Binance #1' => [CurrencyEnum::BINANCE, 'mainnet', true, '0x3f5CE5FBFe3E9af3971dD833D26bA9b5C936f0bE'],
            'Binance #2' => [CurrencyEnum::BINANCE, 'testnet', true, '0x3f5CE5FBFe3E9af3971dD833D26bA9b5C936f0bE'],
            //
            'BitcoinCash #1' => [CurrencyEnum::BITCOIN_CASH, 'mainnet', true, 'bitcoincash:qp009ldhprp75mgn4kgaw8jvrpadnvg8qst37j42kx'],
            'BitcoinCash #2' => [CurrencyEnum::BITCOIN_CASH, 'mainnet', true, 'bitcoincash:qz7032ylhvxmndkx438pd8kjd7k7zcqxzsf26q0lvr'],
            'BitcoinCash #3' => [CurrencyEnum::BITCOIN_CASH, 'mainnet', true, '32uLhn19ZasD5bsVhLdDthhM37JhJHiEE2'],
            'BitcoinCash #4' => [CurrencyEnum::BITCOIN_CASH, 'mainnet', false, 'qz52zsruu43sq7ed0srym3g0ktpyjkdkxcm949pl2z'],
            'BitcoinCash #5' => [CurrencyEnum::BITCOIN_CASH, 'mainnet', false, 'qpf8eq7ygvhqjwydk9n29f6nyc8rcjhlwcuwngn6xk'],
            'BitcoinCash #6' => [CurrencyEnum::BITCOIN_CASH, 'testnet', true, 'bchtest:qp2vjh349lcd22hu0hv6hv9d0pwlk43f6u04d5jk36'],
            'BitcoinCash #7' => [CurrencyEnum::BITCOIN_CASH, 'testnet', false, 'qp2vjh349lcd22hu0hv6hv9d0pwlk43f6u04d5jk36'],
            'BitcoinCash #8' => [CurrencyEnum::BITCOIN_CASH, 'testnet', false, '1KADKOasjxpNKzbfcKjnigLYWjEFPcMXqf'],
            //
            'Bitcoin #1' => [CurrencyEnum::BITCOIN, 'mainnet', true, '1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2'],
            'Bitcoin #2' => [CurrencyEnum::BITCOIN, 'mainnet', true, 'bc1q6v096h88xmpl662af0nc7wd3vta56zv6pyccl8'],
            'Bitcoin #3' => [CurrencyEnum::BITCOIN, 'testnet', true, 'tb1q27dglj7x4l34mj7j2x7e6fqsexk6vf8kew6qm0'],
            'Bitcoin #4' => [CurrencyEnum::BITCOIN, 'testnet', false, 'tb1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq'],
            'Bitcoin #5' => [CurrencyEnum::BITCOIN, 'mainnet', false, 'tb1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq'],
            'Bitcoin #6' => [CurrencyEnum::BITCOIN, 'testnet', false, '1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2'],
            'Bitcoin #7' => [CurrencyEnum::BITCOIN, 'testnet', false, 'bc1q6v096h88xmpl662af0nc7wd3vta56zv6pyccl8'],
            //
            'Cardano #1' => [CurrencyEnum::CARDANO, 'mainnet', true, 'addr1v9ywm0h3r8cnxrs04gfy7c3s2j44utjyvn5ldjdca0c2ltccgqdes'],
            'Cardano #2' => [CurrencyEnum::CARDANO, 'mainnet', false, 'stake1u9f9v0z5zzlldgx58n8tklphu8mf7h4jvp2j2gddluemnssjfnkzz'],
            'Cardano #3' => [CurrencyEnum::CARDANO, 'mainnet', true, 'addr1qxy3w62dupy9pzmpdfzxz4k240w5vawyagl5m9djqquyymrtm3grn7gpnjh7rwh2dy62hk8639lt6kzn32yxq960usnq9pexvt'],
            //
            'Dashcoin #1' => [CurrencyEnum::DASHCOIN, 'mainnet', true, 'XpESxaUmonkq8RaLLp46Brx2K39ggQe226'],
            'Dashcoin #2' => [CurrencyEnum::DASHCOIN, 'mainnet', true, 'XmZQkfLtk3xLtbBMenTdaZMxsUBYAsRz1o'],
            'Dashcoin #3' => [CurrencyEnum::DASHCOIN, 'testnet', true, 'yNpxAuCGxLkDmVRY12m4qEWx1ttgTczSMJ'],
            'Dashcoin #4' => [CurrencyEnum::DASHCOIN, 'testnet', true, 'yi7GRZLiUGrJfX2aNDQ3v7pGSCTrnLa87o'],
            //
            'Dogecoin #1' => [CurrencyEnum::DOGECOIN, 'mainnet', true, 'DFrGqzk4ZnTcK1gYtxZ9QDJsDiVM8v8gwV'],
            'Dogecoin #2' => [CurrencyEnum::DOGECOIN, 'mainnet', true, 'DMzanBYjj3yYHtCcnEucn7H8LHNY9fARB8'],
            'Dogecoin #3' => [CurrencyEnum::DOGECOIN, 'testnet', true, 'mketxxXxaBeH7AhCBMatdH5ATVad2XHQdj'],
            'Dogecoin #4' => [CurrencyEnum::DOGECOIN, 'testnet', false, 'n3TZFrdPvwGqfPC7vBb8PGgbFwc1Cnxq9h'],
            'Dogecoin #5' => [CurrencyEnum::DOGECOIN, 'testnet', true, 'nd5N1KW1waCicK1vqfwtTcBSbQCHBLv2Um'],
            'Dogecoin #6' => [CurrencyEnum::DOGECOIN, 'testnet', false, 'DFundMr7W8PjB6ZmVwGv1L1WtZ2X3m3KgQ'],
            'Dogecoin #7' => [CurrencyEnum::DOGECOIN, 'mainnet', false, 'n3TZFrdPvwGqfPC7vBb8PGgbFwc1Cnxq9h'],
            //
            'EthereumClassic #1' => [CurrencyEnum::ETHEREUM_CLASSIC, 'mainnet', true, '0xe80b351948D0b87EE6A53e057A91467d54468D91'],
            'EthereumClassic #2' => [CurrencyEnum::ETHEREUM_CLASSIC, 'testnet', true, '0x799aD3Ff7Ef43DfD1473F9b8a8C4237c22D8113F'],
            //
            'Ethereum #1' => [CurrencyEnum::ETHEREUM, 'mainnet', true, '0xe80b351948D0b87EE6A53e057A91467d54468D91'],
            'Ethereum #2' => [CurrencyEnum::ETHEREUM, 'testnet', true, '0x799aD3Ff7Ef43DfD1473F9b8a8C4237c22D8113F'],
            //
            'Litecoin #1' => [CurrencyEnum::LITECOIN, 'mainnet', true, 'MF5yqnMuNoiCiCXbZft7iFgLK5BPG5QKbE'],
            'Litecoin #2' => [CurrencyEnum::LITECOIN, 'mainnet', false, '1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp'],
            'Litecoin #3' => [CurrencyEnum::LITECOIN, 'mainnet', true, '3CDJNfdWX8m2NwuGUV3nhXHXEeLygMXoAj'],
            'Litecoin #4' => [CurrencyEnum::LITECOIN, 'mainnet', true, 'LbTjMGN7gELw4KbeyQf6cTCq859hD18guE'],
            'Litecoin #5' => [CurrencyEnum::LITECOIN, 'mainnet', true, 'MK9xC9sbktt6DHMF6XwA3eZPJ2Vx32AXFT'],
            'Litecoin #6' => [CurrencyEnum::LITECOIN, 'testnet', true, 'mpQA36uSXDGxySjknqHFVMdsLPgPnbm7ku'],
            'Litecoin #7' => [CurrencyEnum::LITECOIN, 'mainnet', true, 'ltc1qf6wcq8kc0unt3wuaszlkms3zkuerxlfaz07zmj'],
            //
            'Ripple #1' => [CurrencyEnum::RIPPLE, 'mainnet', true, 'r4dgY6Mzob3NVq8CFYdEiPnXKboRScsXRu'],
            //
            'Tron #1' => [CurrencyEnum::TRON, 'mainnet', true, 'TC9fKEGcBTfmvXKXLHq5MJDC8P7dhZQM92'],
            'Tron #2' => [CurrencyEnum::TRON, 'testnet', true, 'TRALQkt1v9MjUVn3gT7csfpodJDmnC6q8s'],
            //
            'Zcash #1' => [CurrencyEnum::ZCASH, 'mainnet', true, 't1YQV51DKzKP63xJcynXuRfryMjfmgTJ7Jc'],
            'Zcash #2' => [CurrencyEnum::ZCASH, 'mainnet', true, 't1VJhyyvbi63Cu6nEVVgNHSCokDRa3repZB'],
            'Zcash #3' => [CurrencyEnum::ZCASH, 'testnet', true, 't1VJhyyvbi63Cu6nEVVgNHSCokDRa3repZB'],
            //
            'EOS #1' => [CurrencyEnum::EOS, 'mainnet', true, 'atticlabeosb'],
            'EOS #2' => [CurrencyEnum::EOS, 'mainnet', true, 'bitfinexeos1'],
        ];
    }
}