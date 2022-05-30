<?php

namespace Tonoslfx\EcceWeatherForecast\Tests;

use Tonoslfx\EcceWeatherForecast\EcceWeatherForecastServiceProvider;
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
