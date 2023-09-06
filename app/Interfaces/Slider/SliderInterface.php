<?php
namespace App\Interfaces\Slider;

interface  SliderInterface
{

    public function index();

    public function store($request);

    public function update($request,$item);
    public function update_image($request,$item);

    public function delete($item);

    public function front_index();




}
