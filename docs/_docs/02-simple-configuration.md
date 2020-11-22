---
title: "Simple Configuration"
permalink: /docs/config/simple/
excerpt: "Simple laravel-playcoinrpc configuration to work with single daemon."
classes: wide
---
### Environment Configuration (.env)
You can use [Environment Configuration](https://laravel.com/docs/master/configuration#environment-configuration) file to configure laravel-playcoind.

You must have at least following options defined:
```
PLAYCOIND_USER=(rpcuser from playcoin.conf)
PLAYCOIND_PASSWORD=(rpcpassword from playcoin.conf)
```
See `./config/playcoind.php` and [.env.example](https://github.com/denpawmusic/laravel-playcoinrpc/blob/master/.env.example) files to learn more about supported options and their descriptions.

### Configuration file
Alternatively, you can directly define your configuration in `config/playcoind.php`:
```php
<?php

return [
    ...
        'default' => [
            'scheme'        => 'http',
            'host'          => 'localhost',
            'port'          => 8332,
            'user'          => '(rpcuser from playcoin.conf)',     // required
            'password'      => '(rpcpassword from playcoin.conf)', // required
            'ca'            => null,
            'preserve_case' => false,
            'timeout'       => false,
            'zeromq'        => null,
        ],
    ...
];
```
