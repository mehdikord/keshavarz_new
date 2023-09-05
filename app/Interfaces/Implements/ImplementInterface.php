<?php
namespace App\Interfaces\Implements;

interface ImplementInterface
{

    //Implements
    public function index();

    public function store($request);

    public function update($request,$item);

    public function update_image($request,$item);

    public function delete($item);


    //Categories
    public function categories_index();

    public function categories_store($request);

    public function categories_update($request,$item);

    public function categories_delete($item);

    public function categories_update_image($request,$item);


    //Forms
    public function forms_index();

    public function forms_store($request);

    public function forms_update($request,$item);

    public function forms_delete($item);

    //Front
    public function implement_index();

    public function implement_show($item);



}
