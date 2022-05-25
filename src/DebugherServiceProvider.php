<?php

namespace NovadayCo\Debugher;

use Illuminate\Support\ServiceProvider;

class DebugherServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/debugher.php', 'debugher');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/debugher.php' => config_path('debugher.php'),
            ], 'config');

        }
    }
}
