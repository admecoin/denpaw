<?php

declare(strict_types=1);

namespace Denpaw\Playcoin;

use BadMethodCallException;
use Illuminate\Support\Arr;

class LaravelClient extends Client
{
    /**
     * ZeroMQ connection.
     *
     * @var \Denpaw\Playcoin\ZeroMQ\Connection|null
     */
    protected $zeromq = null;

    /**
     * Constructs new client wrapper.
     *
     * @param  array  $config
     *
     * @return void
     */
    public function __construct(array $config)
    {
        if (class_exists('Denpaw\\ZeroMQ\\Manager')) {
            $this->zeromq = new ZeroMQ\Connection(
                Arr::pull($config, 'zeromq'),
                app()->make('Denpaw\ZeroMQ\Manager')
            );
        }

        parent::__construct($config);
    }

    /**
     * Adds new listener.
     *
     * @param  string    $topic
     * @param  callable  $callback
     *
     * @return void
     */
    public function on(string $topic, callable $callback): void
    {
        if (is_null($this->zeromq)) {
            throw new BadMethodCallException(
                'ZeroMQ support is not available, because '.
                '"denpaw/laravel-zeromq" package is not installed. '.
                'Please install it.'
            );
        }

        $this->zeromq->add(new ZeroMQ\Listener($topic, $callback));
    }

    /**
     * Gets response handler class name.
     *
     * @return string
     */
    protected function getResponseHandler(): string
    {
        return 'Denpaw\\Playcoin\\Responses\\LaravelResponse';
    }
}
