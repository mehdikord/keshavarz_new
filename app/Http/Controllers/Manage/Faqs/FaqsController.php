<?php

namespace App\Http\Controllers\Manage\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faqs\FaqsRequest;
use App\Interfaces\News\FaqsInterface;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    private FaqsInterface $repository;
    public function __construct(FaqsInterface $faqs)
    {
        $this->repository = $faqs;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(FaqsRequest $request)
    {
        return $this->repository->store($request);
    }
    public function update(Faq $faq,FaqsRequest $request)
    {
        return $this->repository->update($request,$faq);
    }

    public function delete(Faq $faq)
    {
        return $this->repository->delete($faq);
    }
}
