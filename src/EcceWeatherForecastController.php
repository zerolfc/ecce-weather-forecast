<?php

namespace Tonoslfx\EcceWeatherForecast;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tonoslfx\EcceWeatherForecast\EcceWeatherForecast;
use Tonoslfx\EcceWeatherForecast\Models\ForecastIp as ForecastIpModel;
use Tonoslfx\EcceWeatherForecast\Repositories\Forecast as ForecastRepo;
use Tonoslfx\EcceWeatherForecast\Repositories\ForecastIp as ForecastIpRepo;


class EcceWeatherForecastController extends Controller
{

    protected $forecast;

    public function __construct(EcceWeatherForecast $forecast)
    {

        $this->forecast = $forecast;

    }


    public function index(Request $request)
    {

        $initialIp = collect([
            '123.211.61.50',
            '122.62.248.72',
            '23.19.62.102',
            '105.225.185.20',
            '80.62.117.27',
            '68.96.102.16',
            '103.242.39.92',
            '156.0.201.255'
        ]);

        $ips = ForecastIpModel::all();


        $initialIp->each(function($ip) use($ips) {

            if (!$ips->firstWhere('ip_address', $ip)) {
                $ips->push(collect(['ip_address' => $ip]));
            }

        });


        return view('tonoslfx::forecast', compact('ips'));

    }

    public function ip(Request $request, string $ip)
    {

        try {

            $forecast = ForecastIpModel::with('forecast5Days')
            ->whereIpAddress($this->_validIp($ip))
            ->first();

            if(!$forecast) {

                $this->_storeData($ip);

                $forecast = ForecastIpModel::with('forecast5Days')
                ->whereIpAddress($ip)
                ->first();

            }

            /**
             * Return json if required
             */
            if($request->input('format') == 'json') {

                return response()->json($forecast);

            }

            return view(
                'tonoslfx::ip',
                compact('ip', 'forecast')
            );


        } catch ( ValidationException $e ) {

            return redirect()->route('forecast.index');

        }




    }

    public function post(Request $request)
    {


        $request->validate([
            'ip' => ['required', 'ip']
        ]);

        $this->_storeData($request->input('ip'));


        return redirect()->route('forecast.ip', $request->input('ip'));

    }

    private function _storeData(string $ip)
    {

        $forecastData = $this->forecast->forecast(
            $this->_validIp($ip)
        );

        if ($forecastData) {

            /**
             * Save data to the database
             */
            $forecastIpResult = ForecastIpRepo::save(
                request()->merge([
                    'ip' => $ip,
                    'data' => $forecastData
                ])
            );

            ForecastRepo::save(
                $forecastIpResult,
                $forecastData
            );
        }

        return $forecastData;

    }


    private function _validIp(string $ip)
    {

        if(!filter_var($ip, FILTER_VALIDATE_IP)) {

            abort(400, 'IP is invalid');

        }

        return $ip;

    }

}
