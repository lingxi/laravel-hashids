<?php

namespace Lingxi\Hashids;

use Hashids\Hashids;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * This is the Hashids service provider class.
 *
 * @author Vincent Klaiber <hello@Lingxi.com>
 */
class HashidsServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/hashids.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('hashids.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('hashids');
        }

        $this->mergeConfigFrom($source, 'hashids');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
        $this->registerRoutes();
        $this->registerCommands();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('hashids.factory', function () {
            return new HashidsFactory();
        });

        $this->app->alias('hashids.factory', HashidsFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('hashids', function (Container $app) {
            $config = $app['config'];
            $factory = $app['hashids.factory'];

            return new HashidsManager($config, $factory);
        });

        $this->app->alias('hashids', HashidsManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('hashids.connection', function (Container $app) {
            $manager = $app['hashids'];

            return $manager->connection();
        });

        $this->app->alias('hashids.connection', Hashids::class);
    }

    /**
     * Register the debug routes.
     *
     * @return void
     */
    public function registerRoutes()
    {
        if (config('app.debug')) {
            include __DIR__ . '/../include/routes.php';
        }
    }

    /**
     * Register commands to help debug.
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->commands([
            'Lingxi\Hashids\Console\Commands\DecodeId',
            'Lingxi\Hashids\Console\Commands\EncodeId'
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'hashids',
            'hashids.factory',
            'hashids.connection',
        ];
    }
}
