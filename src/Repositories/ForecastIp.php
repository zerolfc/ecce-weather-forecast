<?php

namespace Tonoslfx\EcceWeatherForecast\Repositories;

use Tonoslfx\EcceWeatherForecast\Models\ForecastIp as Model;
use Tonoslfx\EcceWeatherForecast\Contracts\ForecastIpContract;
use Illuminate\Http\Request;


class ForecastIp implements ForecastIpContract {


    public static function save(Request $request)
    {


        $data = [
            'location_name' => null,
            'latitude' => 0,
            'longitude' => 0,
        ];

        if($request->input('data.daily_units')) {

            $data['location_name'] = $request->input('data.city');
            $data['latitude'] = $request->input('data.latitude', 0);
            $data['longitude'] = $request->input('data.longitude', 0);

        } else {

            $data['location_name'] = $request->input('data.location.name');
            $data['latitude'] = $request->input('data.location.latitude', 0);
            $data['longitude'] = $request->input('data.location.longitude', 0);

        }


        return Model::firstOrCreate([
            'ip_address' => $request->input('ip')
        ], $data);


    }


}
