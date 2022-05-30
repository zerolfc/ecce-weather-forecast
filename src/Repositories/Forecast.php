<?php

namespace Zerolfc\EcceWeatherForecast\Repositories;

use Zerolfc\EcceWeatherForecast\Models\Forecast as Model;
use Zerolfc\EcceWeatherForecast\Contracts\ForecastContract;
use Zerolfc\EcceWeatherForecast\Models\ForecastIp;


class Forecast implements ForecastContract
{

    /**
     * save forecast data
     *
     * @param ForecastIp $forecastIp
     * @param array $data
     * @return void
     */
    public static function save(ForecastIp $forecastIp, array $data)
    {

        // Open meteo has always return daily_units
        if(isset($data['daily_units'])) {

            return self::saveOpenMeteo($forecastIp, $data);

        } else {

            return self::saveWetherApi($forecastIp, $data);

        }


    }


    /**
     * Check WetherApi doc for response format
     *
     * @param ForecastIp $fipModel
     * @param array $data
     * @return void
     */
    private static function saveWetherApi(ForecastIp $fipModel, array $data)
    {

        if(!isset($data['forecast']['forecastday'])) return false;

        foreach($data['forecast']['forecastday'] as $day) {

            Model::firstOrCreate([
                'ip_id' => $fipModel->id,
                'date' => $day['date'],
            ], [
                'mintemp_c' => $day['day']['mintemp_c'],
                'mintemp_f' => $day['day']['mintemp_f'],
                'maxtemp_c' => $day['day']['maxtemp_c'],
                'maxtemp_f' => $day['day']['maxtemp_f'],
                'avgtemp_c' => $day['day']['avgtemp_c'],
                'avgtemp_f' => $day['day']['avgtemp_f'],
                'uv' => $day['day']['uv'],
                'condition_text' => $day['day']['condition']['text'] ?? null,
                'icon' => $day['day']['condition']['icon'] ?? null,
            ]);

        }
    }


    private static function saveOpenMeteo(ForecastIp $fipModel, array $data)
    {


        if (!isset($data['daily']['time'])) return false;

        foreach($data['daily']['time'] as $key => $day) {

            Model::firstOrCreate([
                'ip_id' => $fipModel->id,
                'date' => $day,
            ], [
                'mintemp_c' => $data['daily']['temperature_2m_min'][$key],
                'maxtemp_c' => $data['daily']['temperature_2m_max'][$key],
                'icon' => null,
            ]);

        }


    }
}
