# php-cryptocurrency-address-validation

Easy to use PHP Bitcoin and Litecoin address validator.
One day I will add other crypto currencies. Or how about you? :)

## Usage


```php
use Merkeleon\PhpCryptocurrencyAddressValidation\Validation\BTC as BTCValidator;

$validator = new BTCValidator('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp');
var_dump($validator->validate());

```
