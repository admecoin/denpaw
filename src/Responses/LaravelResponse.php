<?php

declare(strict_types=1);

namespace Denpaw\Playcoin\Responses;

use Illuminate\Support\Collection;

class LaravelResponse extends PlaycoindResponse
{
    /**
     * Gets result as Laravel Collection.
     *
     * @param string|null $key
     *
     * @return \Illuminate\Support\Collection
     */
    public function collect(?string $key = null): Collection
    {
        return new Collection($this->get($key));
    }
}
