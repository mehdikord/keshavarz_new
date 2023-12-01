<?php
namespace App\Repository\Faqs;


use App\Interfaces\Faqs\FaqsInterface;
use App\Models\Faq;

class FaqsRepository implements FaqsInterface
{
    public function index()
    {
        return response_success(Faq::orderBy('num','ASC')->get());
    }

    public function store($request)
    {
        $item = Faq::create([
            'title' => $request->title,
            'num' => $request->num,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'title' => $request->title,
            'num' => $request->num,
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
