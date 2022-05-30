<?php

namespace Zerolfc\EcceWeatherForecast\Contracts;

use Illuminate\Http\Request;
use Zerolfc\EcceWeatherForecast\Models\ForecastIp;

interface ForecastContract {

    public static function save(ForecastIp $forecastIp, array $data);

}
