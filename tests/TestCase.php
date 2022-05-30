<?php

namespace Zerolfc\EcceWeatherForecast\Tests;

use Zerolfc\EcceWeatherForecast\EcceWeatherForecastServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Add the package's service provider.
     *
     * @param $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [EcceWeatherForecastServiceProvider::class];
    }
}
