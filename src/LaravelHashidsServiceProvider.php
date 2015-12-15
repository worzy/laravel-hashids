<?php namespace Alexsoft\LaravelHashids;

use Hashids\Hashids;
use Illuminate\Support\ServiceProvider;

class LaravelHashidsServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hashids', function ($app) {
            return new Hashids(
                $app['config']['app.key'],
                $app['config']['hashids.length'],
                $app['config']['hashids.alphabet']
            );
        });

        $this->publishes([__DIR__ . '/config/hashids.php' => config_path('hashids.php')]);
        $this->mergeConfigFrom(__DIR__ . '/config/hashids.php', 'hashids');

    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return ['hashids'];
    }

}
