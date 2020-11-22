<?php

declare(strict_types=1);

namespace Denpaw\Playcoin\Facades;

use Illuminate\Support\Facades\Facade;

class Playcoind extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'playcoind';
    }
}
