---
title: "Multiple Daemons"
permalink: /docs/config/multiple-daemons/
excerpt: "Configuring laravel-playcoinrpc to work with multiple daemons."
classes: wide
---
Since [version 1.2.0]({{ 'release/1.2.0' | relative_url }}), laravel-playcoinrpc allows you to use multiple configurations to connect to different playcoin or even altcoin daemons.

You'll need to define parameters for each of your connections in `./config/playcoind.php` (see [example](https://github.com/denpawmusic/laravel-playcoinrpc/blob/master/config/config.php#L108))

```php
<?php

return [
    ...
        // Playcoin Core
        'default' => [
            'scheme'   => 'http',
            'host'     => 'localhost',
            'port'     => 8332,
            'user'     => '(rpcuser from playcoin.conf)',     // required
            'password' => '(rpcpassword from playcoin.conf)', // required
            'ca'       => null,
            'timeout'  => false,
            'zeromq'   => null,
        ],

        // Litecoin Core
        'litecoin' => [
            'scheme'   => 'http',
            'host'     => 'localhost',
            'port'     => 9332,
            'user'     => '(rpcuser from litecoin.conf)',     // required
            'password' => '(rpcpassword from litecoin.conf)', // required
            'ca'       => null,
            'timeout'  => false,
            'zeromq'   => null,
        ],
    ...
];
```

Then, you can call specific configuration by passing it's name to `client()` method through any means described in [Making Requests]({{ 'docs/request/standard' | relative_url }}) section.
```php
$blockhash = playcoind()
    ->client('litecoin')
    ->getBestBlockHash();
```