<?php

use Zerolfc\EcceWeatherForecast\EcceWeatherForecastController;

Route::get('forecast', [EcceWeatherForecastController::class, 'index'])
->middleware('web')
->name('forecast.index');

Route::post('forecast', [EcceWeatherForecastController::class, 'post'])
->middleware('web')
->name('forecast.post');

Route::get('forecast/{ip}', [EcceWeatherForecastController::class, 'ip'])
->middleware('web')
->name('forecast.ip');

