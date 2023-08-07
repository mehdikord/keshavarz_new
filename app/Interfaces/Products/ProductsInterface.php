<?php
namespace App\Interfaces\Products;

interface ProductsInterface
{

    public function index();

    public function store($request);

    public function update($request,$item);

    public function delete($item);

    public function activation($item);




}
