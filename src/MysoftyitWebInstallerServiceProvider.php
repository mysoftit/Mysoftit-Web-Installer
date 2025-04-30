<?php

namespace MySoftITWebInstaller;

use Illuminate\Support\ServiceProvider;
use MySoftITWebInstaller\Middleware\CanInstall;

class MySoftITWebInstallerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Load views
        $this->loadViewsFrom(__DIR__.'/Views', 'installer');

        // Publish assets
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/installer'),
        ], 'public');

        // Register middleware
        $this->app['router']->aliasMiddleware('can_install', CanInstall::class);

        // Publish config file (optional)
        $this->publishes([
            __DIR__.'/config.php' => config_path('installer.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'installer'
        );

        // Register services
        $this->app->singleton(EnvironmentService::class, function ($app) {
            return new EnvironmentService();
        });

        $this->app->singleton(DatabaseService::class, function ($app) {
            return new DatabaseService();
        });
    }
}