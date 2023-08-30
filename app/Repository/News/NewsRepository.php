<?php
namespace App\Repository\News;


use App\Interfaces\News\NewsInterface;
use App\Models\News;

class NewsRepository implements NewsInterface
{
    public function index()
    {
        return response_success(News::OrderbyDesc('id')->get());
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

    public function latest()
    {
        return response_success(News::OrderbyDesc('id')->take(3)->get());

    }


}
