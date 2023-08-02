<?php
namespace App\Interfaces\Brands;

interface BrandsInterface
{

    public function index();

    public function store($request);

    public function update($request,$item);

    public function delete($item);




}
