# Cryptocurrency Address Validation with PHP

Easy to use Cryptocurrency Address Validation.
One day I will add other crypto currencies. Or how about you? :)

## Installation

```
composer require merkeleon/php-cryptocurrency-address-validation
```

## Usage

```php
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

$validator = Validation::make('BTC');
var_dump($validator->validate('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp'));

```

## List Of Support

1. ADA
2. BCH
3. BNB
4. BSV
5. BTC
6. DASH
7. DOGE
8. ETC
9. ETH
10. LTC
11. NEO
12. TADA
13. TBCH
14. TBTC
15. TRX
16. XRP
17. ZEC


