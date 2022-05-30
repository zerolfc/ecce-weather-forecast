<?php

namespace Tonoslfx\EcceWeatherForecast\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastIp extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function forecast5Days()
    {

        return $this->hasMany(Forecast::class, 'ip_id')
        ->whereBetween('date', [date('Y-m-d'), now()->addDays(5)->format('Y-m-d')])
        ->limit('5');

    }

}
