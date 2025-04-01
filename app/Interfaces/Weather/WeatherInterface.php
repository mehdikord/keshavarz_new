<?php
namespace App\Interfaces\Weather;
interface WeatherInterface{

    public function current($request);
    public function exclude($request);


}
