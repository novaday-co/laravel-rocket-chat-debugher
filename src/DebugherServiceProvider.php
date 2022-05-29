<?php

namespace Novaday\Debugher;

use Illuminate\Support\ServiceProvider;
use Novaday\Debugher\Providers\EventServiceProvider;

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
        $this->app->register(EventServiceProvider::class);
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

            \Artisan::call('vendor:publish', [
                '--provider' => DebugherServiceProvider::class,
                '--tag' => ['config'],
                '--force' => true,
            ]);

        }
    }
}
