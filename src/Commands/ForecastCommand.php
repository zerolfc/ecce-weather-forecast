<?php

namespace Tonoslfx\EcceWeatherForecast\Commands;

use Illuminate\Config\Repository;
use Illuminate\Console\Command;
use Tonoslfx\EcceWeatherForecast\Models\ForecastIp as ForecastIpModel;

class ForecastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast:check {ip} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weather forecast checker';


    public function handle(Repository $config)
    {

        $ip = $this->argument('ip');


        if (!filter_var($ip, FILTER_VALIDATE_IP)) {

            $this->error('IP is invalid');

            return false;

        }

        $forecast = ForecastIpModel::with('forecast5Days')
        ->whereIpAddress($ip)
        ->first();

        if(!$forecast) {
            $this->error('Forecast does not exists');
        }

        $this->info($forecast);

    }
}
