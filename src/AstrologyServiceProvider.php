<?php

namespace ismailcaakir\Astrology;

use Illuminate\Support\ServiceProvider;

class AstrologyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ismailcaakir');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'ismailcaakir');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/astrology.php' => config_path('astrology.php'),
            ], 'astrology.config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/ismailcaakir'),
            ], 'astrology.views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/ismailcaakir'),
            ], 'astrology.views');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/ismailcaakir'),
            ], 'astrology.views');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/astrology.php', 'astrology');

        // Register the service the package provides.
        $this->app->singleton('astrology', function ($app) {
            return new Astrology;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['astrology'];
    }
}