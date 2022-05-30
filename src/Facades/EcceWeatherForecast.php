<?php

namespace Zerolfc\EcceWeatherForecast\Facades;

use Illuminate\Support\Facades\Facade;

class EcceWeatherForecast extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'ecce-weather-forecast';
    }
}
