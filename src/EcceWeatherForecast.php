<?php

namespace Tonoslfx\EcceWeatherForecast;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class EcceWeatherForecast
{

    protected $config = null;

    protected $q;

    public function __construct($config)
    {

        $this->config = $config;

    }


    /**
     * IP address
     *
     * @param string $q
     * @return void
     */
    public function forecast(string $q)
    {

        $this->q = $q;

        if(!array_key_exists($this->config['provider'], $this->providers())) {

            throw new Exception('Weather provider is not supported as yet!');

        }

        $cacheName = md5(__METHOD__.$q.$this->config['provider']);

        // if($forecast = Cache::get($cacheName)) {

        //     return $forecast;

        // }

        $response = $this->_api();

        if(!$response) {
            abort(400, 'No API response');
        }

        Cache::put($cacheName, $response, now()->addWeek());

        return $response;


    }

    /**
     * List of providers
     *
     * @param string $provider
     * @return array|string
     */
    protected function providers(string $provider = '')
    {


        $providers = [
            'weatherapi' => [
                'endpoint' => 'https://api.weatherapi.com/v1/forecast.json',
                'params' => [
                    'q' => $this->q,
                    'key' => $this->config['key'],
                    'days' => $this->config['days'] ?? 5
                ]
            ],
            'open-meteo' => [
                'endpoint' => 'https://api.open-meteo.com/v1/forecast',
                'params' => [
                    'latitude' => '',
                    'longitude' => '',
                    'timezone' => 'Europe/London',
                    'daily' => ['temperature_2m_max', 'temperature_2m_min']
                ]
            ]
        ];

        if($provider) {

            $cacheName = md5(__METHOD__ . $provider);

            $output = $providers[$provider];

            if($provider == 'open-meteo') {

                $getCoordinate = Cache::get($cacheName);

                if(!$getCoordinate) {

                    $getCoordinate = Http::get('http://ip-api.com/json/24.48.0.1');

                    if ($getCoordinate->ok()) {

                        $getCoordinate = $getCoordinate->json();

                        Cache::put($cacheName, $getCoordinate, now()->addMonth());

                    }

                }


                $output['params']['latitude'] = $getCoordinate['lat'];
                $output['params']['longitude'] = $getCoordinate['lon'];
                $output['params']['city'] = $getCoordinate['city'];


            }

            return $output;

        }


        return $providers;

    }

    /**
     * Weather API endpoint
     *
     * @return Object
     */
    private function _api()
    {

        $provider = $this->providers($this->config['provider']);

        $response = Http::get($provider['endpoint'], $provider['params']);

        if ($response->ok()) {

            $data = $response->json();

            if ($this->config['provider'] == 'open-meteo') {

                $data['city'] = $provider['params']['city'] ?? '';
            }

            return $data;


        }


    }

}
