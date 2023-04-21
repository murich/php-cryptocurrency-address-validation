<?php

declare(strict_types=1);

namespace Merkeleon\PhpCryptocurrencyAddressValidation\Enums;

enum CurrencyEnum: string
{
    case BEACON = 'beacon';
    case BINANCE = 'binance';
    case BITCOIN_CASH = 'bitcoin_cash';
    case BITCOIN = 'bitcoin';
    case CARDANO = 'cardano';
    case DASHCOIN = 'dashcoin';
    case DOGECOIN = 'dogecoin';
    case EOS = 'eos';
    case ETHEREUM_CLASSIC = 'ethereum_classic';
    case ETHEREUM = 'ethereum';
    case LITECOIN = 'litecoin';
    case RIPPLE = 'ripple';
    case STELLAR = 'stellar';
    case TRON = 'tron';
    case ZCASH = 'zcash';
}
