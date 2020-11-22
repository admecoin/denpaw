<?php

declare(strict_types=1);

namespace Denpaw\Playcoin\Traits;

use Denpaw\Playcoin\ClientFactory;

trait Playcoind
{
    /**
     * Get playcoind client factory instance.
     *
     * @return \Denpaw\Playcoin\ClientFactory
     */
    public function playcoind(): ClientFactory
    {
        return app('playcoind');
    }
}
