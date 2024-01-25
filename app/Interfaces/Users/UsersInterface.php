<?php
namespace App\Interfaces\Users;

interface UsersInterface
{

    //Management
    public function managers_index();

    public function managers_store($request);

    public function managers_update($request,$item);

    public function managers_delete($item);

    //Members
    public function members_index();

    public function members_store($request);

    public function members_show($item);

    public function members_trashed();
    public function members_update($request,$item);

    public function members_delete($item);

    public function members_activation($item);

    public function members_invoices($item);

    public function members_invoices_create($request,$item);

    public function members_active_provider($item);

    public function members_active_customer($item);


}
