---
title: "ZeroMQ"
permalink: /docs/zeromq/
excerpt: "How to configure laravel-playcoinrpc to work with ZMQ."
toc: true
toc_label: "Using ZeroMQ"
---
ZeroMQ support is available since [version 1.2.5]({{ 'release/1.2.5' | relative_url }}) via [denpaw/laravel-zeromq](https://packagist.org/packages/denpaw/laravel-zeromq) package.
### Installing ZeroMQ support package
You'll need to install laravel-zeromq package by running composer
```sh
composer require denpaw/laravel-zeromq "^1.0"
```
or manually add following lines to the `composer.json`
```json
"require": {
    "denpaw/laravel-zeromq": "^1.0"
}
```

### Playcoin Core Configuration
Your Playcoin Core must be compiled with libzmq (many distributions compile playcoind with libzmq by default)

In order to check this, run
```sh
(playcoind -h | grep -q zmq) && echo "ZeroMQ support available"`
```
If you get "ZeroMQ support available", then you can use ZeroMQ, otherwise please [build](https://github.com/playcoin/playcoin/blob/master/doc/build-unix.md) Playcoin Core with zmq support yourself.

Once have Playcoin Core with ZeroMQ support, set the following options in playcoind.conf (host and port can be different):
```
zmqpubhashtx=tcp://127.0.0.1:28332
zmqpubhashblock=tcp://127.0.0.1:28332
zmqpubrawblock=tcp://127.0.0.1:28332
zmqpubrawtx=tcp://127.0.0.1:28332
```

### Package Configuration
Set `zeromq` key for your connection in `config/playcoind.php`:
```php
'default' => [
    ...
    'zeromq' => [
        'host' => '127.0.0.1',
        'port' => 28332,
    ],
],
```

### Subscribing to topics
You can subscribe to ZeroMQ topics using `on($topic, callable $callback)` method as illustrated in example below.
```php
playcoind()->on('hashblock', function ($blockhash, $sequence) {
    // $blockhash var now contains block hash
    // of newest block broadcasted by daemon
    $block = playcoind()->getBlock($blockhash);

    printf(
        "New block %u found. Contains %u transactions.\n",
        $block['height'],
        $block->count('tx')
    );
});
```
List of available topics:
* __hashblock__ - broadcasts hash of each new block being added to the blockchain.
* __hashtx__ - broadcasts hash of transaction being added to node's mempool.
* __rawblock__ - broadcasts new block being added to the blockchain as raw hex string.
* __rawtx__ - broadcasts transaction being added to node's mempool as raw hex string.

For more information about ZeroMQ and it's usage, visit Playcoin Core [Documentation](https://github.com/playcoin/playcoin/blob/master/doc/zmq.md).
