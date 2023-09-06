<?php
namespace App\Repository\News;


use App\Interfaces\News\NewsInterface;
use App\Models\News;
use App\Services\MediaServices\MediaService;

class NewsRepository implements NewsInterface
{
    public function index()
    {
        return response_success(News::OrderbyDesc('id')->get());
    }

    public function store($request)
    {
        $image=null;
        if ($request->file('image')){
            $image = (new MediaService())->store_image($request->file('image'),'news');
        }

        $item = News::create([
            'title' => $request->title,
            'image' => $image,
            'link' => $request->link,
            'description' => $request->description,
        ]);
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
        ]);
        return response_success($item);
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    public function update_image($request,$item)
    {
        if ((new MediaService)->update_model_image($request,$item,'image','news')){

            return response_success($item);
        }
        return response_custom_error('image file update error');
    }


    public function latest()
    {
        return response_success(News::OrderbyDesc('id')->take(3)->get());

    }


}
