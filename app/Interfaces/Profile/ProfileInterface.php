<?php
namespace App\Interfaces\Profile;

interface ProfileInterface
{

    //Management
    public function manage_me();

    //Users
    public function user_me();

    public function user_update($request);

    public function user_update_image($request);

    public function range_update($request);

    public function implement();

    public function implement_update($request);

    public function implement_request($request);

    public function implement_edit($item,$request);

    public function implement_delete($item);

    public function index_gallery();

    public function store_gallery($request);

    public function delete_gallery($item);

    public function get_days();
    public function store_days($request);
    public function delete_days($item);

}
