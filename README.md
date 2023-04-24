# php-cryptocurrency-address-validation

Easy to use PHP Bitcoin and Litecoin address validator.
One day I will add other crypto currencies. Or how about you? :)

## Usage

```php
use Merkeleon\PhpCryptocurrencyAddressValidation\Enums\CurrencyEnum;use Merkeleon\PhpCryptocurrencyAddressValidation\Validator;

$validator = Validator::make(CurrencyEnum::BITCOIN);
var_dump($validator->isValid('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp'));

```
