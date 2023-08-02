<?php
namespace App\Repository\Brands;


use App\Interfaces\Faqs\FaqsInterface;
use App\Models\Faq;

class BrandsRepository implements FaqsInterface
{
    public function index()
    {
        return response_success(Faq::OrderbyDesc('id')->get());
    }

    public function store($request)
    {
        $item = Faq::create([
            'title' => $request->title,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'title' => $request->title,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        return response_success($item);
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }


}
