<?php

namespace App\Http\Controllers\Manage\Implements;

use App\Http\Controllers\Controller;
use App\Http\Requests\Implements\ImplementsFormsStoreRequest;
use App\Http\Requests\Implements\ImplementsFormsUpdateRequest;
use App\Interfaces\Implements\ImplementInterface;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    protected ImplementInterface $repository;

    public function __construct(ImplementInterface $implement)
    {
        $this->repository = $implement;
    }

    public function index()
    {
        return $this->repository->forms_index();
    }

    public function store(ImplementsFormsStoreRequest $request)
    {
        return $this->repository->forms_store($request);
    }

    public function update(Form $form,ImplementsFormsUpdateRequest $request)
    {
        return $this->repository->forms_update($request,$form);
    }

    public function delete(Form $form)
    {
        return $this->repository->forms_delete($form);
    }

}
