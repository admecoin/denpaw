---
title: "Standard Request"
permalink: /docs/request/standard/
excerpt: "Making standard synchronous request via laravel-playcoinrpc."
toc: true
toc_label: "Make request with"
---
The package provides various way to call <abbr title="JavaScript Object Notation Remote Procedure Call">JSON-RPC</abbr> methods.

You can use them interchangeably, if needed.
However, if you don't plan to unit-test your application, helper method is preferred as it's easiest one to use.

_Note: method names are case-insensitive, so getBlock() and getblock() will yield the same result._

### Helper
Helper functions provide an easy way to call JSON-RPC methods.
They are, however, make testing somewhat difficult and can cause name collisions.

The following example illustrates the use of `playcoind()` helper to call the [getBlock()](https://playcoin.org/en/developer-reference#getblock) method.
```php
<?php

namespace App\Http\Controllers;

class PlaycoinController extends Controller
{
  /**
   * Get block info.
   *
   * @return \Illuminate\Http\JsonResponse
   */
   public function blockInfo()
   {
      $hash = '000000000019d6689c085ae165831e934ff763ae46a2a6c172b3f1b60a8ce26f';
      $block = playcoind()->getBlock($hash);
      return response()->json($block->get());
   }
}
```

### Trait
Using traits makes a clear declaration of class dependence and, if needed, traits could be easily replaced via namespace.

The following example illustrates the use of `Denpaw\Playcoin\Traits\Playcoind` trait to call the [getBlock()](https://playcoin.org/en/developer-reference#getblock) method.
```php
<?php

namespace App\Http\Controllers;

use Denpaw\Playcoin\Traits\Playcoind;

class PlaycoinController extends Controller
{
  use Playcoind;

  /**
   * Get block info.
   *
   * @return \Illuminate\Http\JsonResponse
   */
   public function blockInfo()
   {
      $hash = '000000000019d6689c085ae165831e934ff763ae46a2a6c172b3f1b60a8ce26f';
      $block = $this->playcoind()->getBlock($hash);
      return response()->json($block->get());
   }
}
```

### Facade
Facades provide a convenient way to make calls and Laravel makes them [easy to mock](https://laravel.com/docs/master/mocking#mocking-facades).
However, they are using static calls which in some cases might be undesirable.

The following example illustrates the use of `Denpaw\Playcoin\Facades\Playcoind` facade to call the [getBlock()](https://playcoin.org/en/developer-reference#getblock) method:
```php
<?php

namespace App\Http\Controllers;

use Denpaw\Playcoin\Facades\Playcoind;

class PlaycoinController extends Controller
{
  /**
   * Get block info.
   *
   * @return \Illuminate\Http\JsonResponse
   */
   public function blockInfo()
   {
      $hash = '000000000019d6689c085ae165831e934ff763ae46a2a6c172b3f1b60a8ce26f';
      $block = Playcoind::getBlock($hash);
      return response()->json($block->get());
   }
}
```

### Automatic Injection
Automatic injection are easiest of bunch to test and, as with traits, is considered by many to be preferred way to access class dependencies due to explicit declaration.

The following example illustrates the use of automatic injection by type-hinting `\Denpaw\Playcoin\ClientFactory` to call the [getBlock()](https://playcoin.org/en/developer-reference#getblock) method:
```php
<?php

namespace App\Http\Controllers;

use Denpaw\Playcoin\LaravelClient as PlaycoinClient;

class PlaycoinController extends Controller
{
  /**
   * Get block info.
   *
   * @param  \Denpaw\Playcoin\Client  $playcoind
   * @return \Illuminate\Http\JsonResponse
   */
   public function blockInfo(PlaycoinClient $playcoind)
   {
      $hash = '000000000019d6689c085ae165831e934ff763ae46a2a6c172b3f1b60a8ce26f';
      $block = $playcoind->getBlock($hash);
      return response()->json($block->get());
   }
}
```

#### Note on multiple configurations
When using automatic injection with more than one configuration defined in config file,
you should type-hint `Denpaw\Playcoin\ClientFactory` instead of `Denpaw\Playcoin\Client` to use
client() method.
```php
<?php

namespace App\Http\Controllers;

use Denpaw\Playcoin\ClientFactory;

class LitecoinController extends Controller
{
  /**
   * Get block info from litecoin.
   *
   * @param  \Denpaw\Playcoin\ClientFactory  $factory
   * @return \Illuminate\Http\JsonResponse
   */
   public function litecoinBlockInfo(ClientFactory $factory)
   {
      $hash = '3e68d2f1e226cd78dc595b5432b5f00db5d89fc1ddf525d55176a84af65fa0b0';
      $litecoind = $factory->client('litecoin');
      $block = $litecoind->getBlock($hash);
      return response()->json($block->get());
   }
}
```

See [Multiple Daemons]({{ 'docs/config/multiple-daemons/' | relative_url }}) section to learn more about defining and using multiple configurations.