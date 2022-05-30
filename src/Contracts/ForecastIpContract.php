<?php

namespace Zerolfc\EcceWeatherForecast\Contracts;

use Illuminate\Http\Request;

interface ForecastIpContract
{

    public static function save(Request $request);
}
