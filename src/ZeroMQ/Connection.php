<?php

declare(strict_types=1);

namespace Denpaw\Playcoin\ZeroMQ;

use Denpaw\ZeroMQ\Manager;

class Connection
{
    /**
     * Is connection open.
     *
     * @var bool
     */
    public $open = false;

    /**
     * ZeroMQ connection instance.
     *
     * @var \Denpaw\ZeroMQ\Connection
     */
    protected $zeromq;

    /**
     * Constructs new ZeroMQ connection.
     *
     * @param  array|null  $config
     * @param  \Denpaw\ZeroMQ\Manager  $manager
     *
     * @return void
     */
    public function __construct(?array $config, Manager $manager)
    {
        if (! is_null($config)) {
            $this->zeromq = $manager->make($this->withDefaults($config));
            $this->open = true;
        }
    }

    /**
     * Adds new listener.
     *
     * @param  \Denpaw\Playcoin\ZeroMQ\Listener  $listener
     *
     * @return void
     */
    public function add(Listener $listener): void
    {
        if ($this->open) {
            $listener->listenOn($this->zeromq);
        }
    }

    /**
     * Appends configuration array with default values.
     *
     * @param  array  $config
     *
     * @return array
     */
    protected function withDefaults(array $config = []): array
    {
        return array_merge([
            'protocol' => 'tcp',
            'host'     => 'localhost',
            'port'     => 28332,
        ], $config);
    }
}
