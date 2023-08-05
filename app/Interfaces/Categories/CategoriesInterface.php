<?php
namespace App\Interfaces\Categories;

interface CategoriesInterface
{

    public function index();

    public function store($request);

    public function update($request,$item);
    public function update_image($request,$item);

    public function delete($item);




}
