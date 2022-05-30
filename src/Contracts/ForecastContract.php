<?php

namespace Tonoslfx\EcceWeatherForecast\Contracts;

use Illuminate\Http\Request;
use Tonoslfx\EcceWeatherForecast\Models\ForecastIp;

interface ForecastContract {

    public static function save(ForecastIp $forecastIp, array $data);

}
