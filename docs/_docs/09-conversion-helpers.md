---
title: "Conversion Helpers"
permalink: /docs/conversion-helpers/
excerpt: "List of helper methods provided by php-playcoinrpc package."
classes: wide
---
php-playcoinrpc package provides a handful of methods to assist with value conversion.  
Those methods are available in `Denpaw\Playcoin` namespace.

#### `to_playcoin()`

Converts value from satoshi to playcoin.
```php
echo \Denpaw\Playcoin\to_playcoin(100000); // 0.00001
```

#### `to_satoshi()`

Converts value from playcoin to satoshi.
```php
echo \Denpaw\Playcoin\to_satoshi(0.00001); // 100000
```

#### `to_ubtc()`
Converts value from playcoin to ubtc/bits.
```php
echo \Denpaw\Playcoin\to_ubtc(0.001); // 1000.0000
```

#### `to_mbtc()`
Converts value from playcoin to mbtc.
```php
echo \Denpaw\Playcoin\to_mbtc(0.001); // 1.0000
```

#### `to_fixed()`

Trims float value to precision (defaults to 8) without rounding.
```php
echo \Denpaw\Playcoin\to_fixed(0.1236, 3); // 0.123
```
