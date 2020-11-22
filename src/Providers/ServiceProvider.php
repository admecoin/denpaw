<?php

declare(strict_types=1);

namespace Denpaw\Playcoin\Providers;

use Denpaw\Playcoin\ClientFactory;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $path = realpath(__DIR__.'/../../config/config.php');

        $this->publishes([$path => config_path('playcoind.php')], 'config');
        $this->mergeConfigFrom($path, 'playcoind');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerAliases();

        $this->registerFactory();
        $this->registerClient();
    }

    /**
     * Register aliases.
     *
     * @return void
     */
    protected function registerAliases(): void
    {
        $aliases = [
            'playcoind'         => 'Denpaw\Playcoin\ClientFactory',
            'playcoind.client'  => 'Denpaw\Playcoin\LaravelClient',
        ];

        foreach ($aliases as $key => $aliases) {
            foreach ((array) $aliases as $alias) {
                $this->app->alias($key, $alias);
            }
        }
    }

    /**
     * Register client factory.
     *
     * @return void
     */
    protected function registerFactory(): void
    {
        $this->app->singleton('playcoind', function ($app) {
            return new ClientFactory(config('playcoind'), $app['log']);
        });
    }

    /**
     * Register client shortcut.
     *
     * @return void
     */
    protected function registerClient(): void
    {
        $this->app->bind('playcoind.client', function ($app) {
            return $app['playcoind']->client();
        });
    }
}
