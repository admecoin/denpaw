<?php

declare(strict_types=1);

use Denpaw\Playcoin\ClientFactory;

if (! function_exists('playcoind')) {
    /**
     * Get playcoind client instance by name.
     *
     * @return \Denpaw\Playcoin\ClientFactory
     */
    function playcoind(): ClientFactory
    {
        return app('playcoind');
    }
}
