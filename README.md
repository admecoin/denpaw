# Playcoin JSON-RPC Service Provider for Laravel
[![Latest Stable Version](https://poser.pugx.org/denpaw/laravel-playcoinrpc/v/stable)](https://packagist.org/packages/denpaw/laravel-playcoinrpc)
[![License](https://poser.pugx.org/denpaw/laravel-playcoinrpc/license)](https://packagist.org/packages/denpaw/laravel-playcoinrpc)
[![Build Status](https://travis-ci.org/denpawmusic/laravel-playcoinrpc.svg)](https://travis-ci.org/denpawmusic/laravel-playcoinrpc)
[![Code Climate](https://codeclimate.com/github/denpawmusic/laravel-playcoinrpc/badges/gpa.svg)](https://codeclimate.com/github/denpawmusic/laravel-playcoinrpc)
[![Code Coverage](https://codeclimate.com/github/denpawmusic/laravel-playcoinrpc/badges/coverage.svg)](https://codeclimate.com/github/denpawmusic/laravel-playcoinrpc/coverage)
[![Join the chat at https://gitter.im/laravel-playcoinrpc/Lobby](https://badges.gitter.im/laravel-playcoinrpc/Lobby.svg)](https://gitter.im/laravel-playcoinrpc/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

## About
This package allows you to make JSON-RPC calls to Playcoin Core JSON-RPC server from your laravel project.
It's based on [denpaw/php-playcoinrpc](https://github.com/denpawmusic/php-playcoinrpc) project - fully unit-tested Playcoin JSON-RPC client powered by GuzzleHttp.

## Quick Installation
1. Install package:
```sh
composer require denpaw/laravel-playcoinrpc "^1.2"
```

2. _(skip if using Laravel 5.5 or newer)_ Add service provider and facade to `./config/app.php`
```php
...
'providers' => [
    ...
    Denpaw\Playcoin\Providers\ServiceProvider::class,
];
...
'aliases' => [
    ...
    'Playcoind' => Denpaw\Playcoin\Facades\Playcoind::class,
];
```
3. Publish config file
```sh
php artisan vendor:publish --provider="Denpaw\Playcoin\Providers\ServiceProvider"
```
_Visit [Installation](https://laravel-playcoinrpc.denpaw.pro/docs/install/) for detailed installation guide._

## Usage
This package provides simple and intuitive API to make RPC calls to Playcoin Core (and some altcoins)
```php
$hash = '000000000001caba23d5a17d5941f0c451c4ac221cbaa6c60f27502f53f87f68';
$block = playcoind()->getBlock($hash);
dd($block->get());
```
Check [Usage](https://laravel-playcoinrpc.denpaw.pro/docs/request/standard/) for more information and examples.

## Documentation
Documentation is available [here](https://laravel-playcoinrpc.denpaw.pro/).

## Requirements
* PHP 7.1 or higher
* Laravel 5.2 or higher

_For PHP 5.6 and 7.0 use [laravel-playcoinrpc v1.2.8](https://github.com/denpawmusic/laravel-playcoinrpc/releases/tag/v1.2.8)._

## License
This product is distributed under the [MIT license](https://github.com/denpawmusic/laravel-playcoinrpc/blob/master/LICENSE).

## Donations

If you like this project, please consider donating:<br>
**BTC**: 3L6dqSBNgdpZan78KJtzoXEk9DN3sgEQJu<br>
**Bech32**: bc1qyj8v6l70c4mjgq7hujywlg6le09kx09nq8d350

❤Thanks for your support!❤
