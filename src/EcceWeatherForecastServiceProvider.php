<?php

namespace Zerolfc\EcceWeatherForecast;

use Illuminate\Support\ServiceProvider;
use Zerolfc\EcceWeatherForecast\Commands\ForecastCommand;

class EcceWeatherForecastServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {


        $this->loadViewsFrom(__DIR__.'/../resources/views', 'zerolfc');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ecce-weather-forecast.php', 'ecce-weather-forecast');

        // Register the service the package provides.
        $this->app->singleton(EcceWeatherForecast::class, function ($app) {
            return new EcceWeatherForecast([
                'key' => $app['config']['ecce-weather-forecast']['key'] ?? '',
                'provider' => $app['config']['ecce-weather-forecast']['provider'] ?? '',
            ]);
        });
    }


    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/ecce-weather-forecast.php' => config_path('ecce-weather-forecast.php'),
        ], 'ecce-weather-forecast.config');

        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/zerolfc'),
        ], 'ecce-weather-forecast.views');

        $this->publishes([
            __DIR__ . '/../database/migrations/create_forecasts_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_forecasts_table.php'),
            __DIR__ . '/../database/migrations/create_forecast_ips_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_forecast_ips_table.php'),
        ], 'ecce-weather-forecast.migrations');

        // Registering package commands.
        $this->commands([
            ForecastCommand::class
        ]);
    }
}
