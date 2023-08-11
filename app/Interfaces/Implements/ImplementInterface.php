<?php
namespace App\Interfaces\Implements;

interface ImplementInterface
{

    public function index();

    public function store($request);

    public function update($request,$item);

    public function delete($item);


    public function categories_index();



}
