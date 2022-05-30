# EcceWeatherForecast

## Weather Providers

This package is currently only supported two free weather API provider.

1. [weatherapi.com](https://www.weatherapi.com/) - For free tier only shows 3 day daily weather.

2. [open-meteo.com](https://open-meteo.com/) - does not support icon to represent the weather forecasted.

## Installation

```
composer require tonoslfx/ecce-weather-forecast
```

## Configuration

The default settings are set in `config/ecce-weather-forecast.php`. Publish the config copy the file to your own config:

```
php artisan vendor:publish --tag="ecce-weather-forecast.config"

php artisan vendor:publish --tag="ecce-weather-forecast.migrations"
```


## .env

Add these variable to your `.env` file.

Supported providers are `weatherapi` or `open-meteo`.

```
WEATHER_FORECAST_PROVIDER=weatherapi
WEATHER_FORECAST_KEY=

```
