# php-cryptocurrency-address-validation

Easy to use PHP cryptocurrency address validation lib.

Don't hesitate to add more currencies!

## Usage


```php
use Murich\PhpCryptocurrencyAddressValidation\Validation\BTC as BTCValidator;

$validator = new BTCValidator('1QLbGuc3WGKKKpLs4pBp9H6jiQ2MgPkXRp');
var_dump($validator->validate());

```
