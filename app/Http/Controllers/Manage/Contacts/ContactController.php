<?php

namespace App\Http\Controllers\Manage\Contacts;

use App\Http\Controllers\Controller;
use App\Interfaces\Contacts\ContactsInterface;
use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected ContactsInterface $repository;
    public function __construct(ContactsInterface $contacts)
    {
        $this->repository = $contacts;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function delete(Contacts $contact)
    {
        return $this->repository->delete($contact);
    }
}
