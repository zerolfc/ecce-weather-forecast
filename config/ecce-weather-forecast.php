<?php

return [
    'provider' => env('WEATHER_FORECAST_PROVIDER', 'weatherapi'), // weatherapi or open-meteo
    'key' => env('WEATHER_FORECAST_KEY'),
    'days' => env('WEATHER_DAYS', 5) // if relevant to the API
];
