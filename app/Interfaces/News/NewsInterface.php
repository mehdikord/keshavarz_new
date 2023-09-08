<?php
namespace App\Interfaces\News;

interface NewsInterface
{

    public function index();

    public function latest();

    public function store($request);

    public function update($request,$item);

    public function update_image($request,$item);

    public function delete($item);




}
