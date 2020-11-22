---
title: "Installation"
permalink: /docs/install/
excerpt: "How to install laravel-playcoinrpc package via composer."
classes: wide
---
Preparation
-------------
To install this package, you'll need installed and working Composer.  
Head over to [Official Composer Documentation](https://getcomposer.org/doc/00-intro.md) to learn installation procedure for your OS.

### Installing package
Install the package by running Composer in your project directory
```
composer require denpaw/laravel-playcoinrpc "^1.2"
```
or manually add following lines to the `composer.json`
```json
"require": {
    "denpaw/laravel-playcoinrpc": "^1.2"
}
```

### Registering Provider[^autodiscovery]

Add `Denpaw\Playcoin\Providers\ServiceProvider::class` line to the providers list, somewhere near the bottom of your `./config/app.php` file.
```php
'providers' => [
    ...
    Denpaw\Playcoin\Providers\ServiceProvider::class,
];
```

### Registering Facade[^autodiscovery]

Playcoind facade provides a convenient way to make JSON-RPC calls from anywhere in your code.
To register the facade, append it's record to the aliases list in `./config/app.php` as in the following example.
```php
'aliases' => [
    ...
    'Playcoind' => Denpaw\Playcoin\Facades\Playcoind::class,
];
```

### Publishing config

Publish the config file by running following command in your project directory.
```sh
php artisan vendor:publish --provider="Denpaw\Playcoin\Providers\ServiceProvider"
```

[^autodiscovery]: This step can be skipped for Laravel 5.5 or newer due to [Auto-Discovery](https://laravel-news.com/package-auto-discovery) feature.
