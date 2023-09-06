<?php
namespace App\Repository\Contacts;


use App\Interfaces\Contacts\ContactsInterface;
use App\Models\Contacts;


class ContactsRepository implements ContactsInterface
{
    public function index()
    {
        return response_success(Contacts::OrderbyDesc('id')->get());
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }


}
