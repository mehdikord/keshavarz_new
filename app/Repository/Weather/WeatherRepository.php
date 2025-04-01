<?php
namespace App\Repository\Weather;

use App\Interfaces\Weather\WeatherInterface;
use Illuminate\Support\Facades\Http;

class WeatherRepository implements WeatherInterface
{


    public function current($request)
    {
        $params = [
            'appid' => config('weather.openweathermap.api_key'),
            'lang' => 'en',
            'lat' => null,
            'lon' => null,
            'q' => null,
        ];

        if ($request->filled('location')){
            //get location
            $location = explode(',',$request->location);
            $params['lat'] = $location[0];
                $params['lon'] = $location[1];
        }
        if ($request->filled('city')){
            $params['q'] = $request->city;
        }

        $url = config('weather.openweathermap.url')."?appid=$params[appid]&q=$params[q]&lat=$params[lat]&lon=$params[lon]&lang=$params[lang]&units=metric";
        //send request
        $req = Http::get($url);
        $response = $req->json();
        return response_success($response);

    }

    public function exclude($request)
    {
        $url = null;
        $params = [
            'lat' => null,
            'lon' => null,
        ];
        if ($request->filled('location')){
            //get location
            $location = explode(',',$request->location);
            $params['lat'] = $location[0];
            $params['lon'] = $location[1];
        }
        if ($params['lat'] && $params['lon']){
            if ($request->exclude === 'daily'){
                $url = "https://api.open-meteo.com/v1/forecast?latitude=$params[lat]&longitude=$params[lon]&daily=weather_code,temperature_2m_max,temperature_2m_min,wind_speed_10m_mean,precipitation_probability_mean,precipitation_sum&timezone=Asia%2FTehran&timeformat=unixtime&wind_speed_unit=ms";
            }
            if ($request->exclude === 'hourly'){
                $url = "https://api.open-meteo.com/v1/forecast?latitude=$params[lat]&longitude=$params[lon]&hourly=weather_code,temperature_2m,precipitation,wind_speed_10m,precipitation_probability&forecast_days=3&timezone=Asia%2FTehran&timeformat=unixtime&wind_speed_unit=ms";
            }
        }

        if ($url){
            $req = Http::get($url);
            $response = $req->json();
            return response_success($response);
        }

    }

}
