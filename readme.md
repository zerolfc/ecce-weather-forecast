# EcceWeatherForecast

## Weather Providers

This package is currently only supported two free weather API provider.

1. [weatherapi.com](https://www.weatherapi.com/) - For free tier only shows 3 day daily weather.

2. [open-meteo.com](https://open-meteo.com/) - does not support icon to represent the weather forecasted.

## Installation

```
composer require zerolfc/ecce-weather-forecast
```

## View

Depending on how you set your local server

```
http://{local-url}/forecast
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

## Artisan

You can the weather forecast using artisan terminal

```
php artisan forecast:check {IP-address}
```

## API

You can access the forecasted weather API by adding `format=json` query.

```
http://location:8080/forecast/{IP}?format=json
```
