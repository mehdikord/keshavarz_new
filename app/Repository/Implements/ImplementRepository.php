<?php
namespace App\Repository\Implements;


use App\Interfaces\Implements\ImplementInterface;
use App\Models\Faq;
use App\Models\Implement;
use App\Models\Implement_Category;

class ImplementRepository implements ImplementInterface
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


    public function categories_index()
    {
        return response_success(Implement_Category::orderBy('num','ASC')->get());
    }

    public function implement_index()
    {
        $data=Implement::query();

        if (request()->filled('category')){
            $data->where('implement_category_id',request('category'));
        }
        return response_success($data->get());
    }

    public function implement_show($item)
    {
         $item->load('forms');
         $item->load('forms.form');
        return response_success($item);

    }


}
