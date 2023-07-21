<?php
namespace App\Interfaces\Faqs;

interface FaqsInterface
{

    public function index();

    public function store($request);

    public function update($request,$item);

    public function delete($item);




}
