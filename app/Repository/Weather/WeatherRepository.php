<?php
namespace App\Repository\Weather;

use App\Interfaces\Weather\WeatherInterface;
use Illuminate\Support\Facades\Http;

class WeatherRepository implements WeatherInterface
{


    public function current($request)
    {
        //get location
        $location = explode(',',$request->location);
        if (count($location) > 1){
            $params = [
                'appid' => config('weather.openweathermap.api_key'),
                'lat' => $location[0],
                'lon' => $location[1],
                'lang' => config('weather.openweathermap.lang')
            ];
            $url = config('weather.openweathermap.url')."?appid=$params[appid]&lat=$params[lat]&lon=$params[lon]&lang=$params[lang]&units=metric";
            //send request
            $req = Http::get($url);
            $response = $req->json();
            return response_success($response);


        }
        return response_custom_error('location not available');
    }

}
