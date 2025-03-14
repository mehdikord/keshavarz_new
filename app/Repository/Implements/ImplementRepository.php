<?php
namespace App\Repository\Implements;


use App\Http\Resources\Implements\Categories\ImplementCategoriesShortResource;
use App\Interfaces\Implements\ImplementInterface;
use App\Models\Faq;
use App\Models\Form;
use App\Models\Implement;
use App\Models\Implement_Category;
use App\Models\Implement_Request;
use App\Services\MediaServices\MediaService;

class ImplementRepository implements ImplementInterface
{
    public function index()
    {
        return response_success(Implement::with('category')->with('forms')->withCount('search')->withCount('users')->orderByDesc('id')->get());
    }

    public function store($request)
    {
        $image=null;
        if ($request->file('image')){
            $image = (new MediaService())->store_image($request->file('image'),'implements/implements');
        }
        $item = Implement::create([
            'name' => $request->name,
            'implement_category_id' => $request->implement_category_id,
            'price_type' => $request->price_type,
            'image' => $image,
            'long_description' => $request->description,
            'is_special' => $request->is_special,
        ]);
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'name' => $request->name,
            'implement_category_id' => $request->implement_category_id,
            'price_type' => $request->price_type,
            'long_description' => $request->description,
            'is_special' => $request->is_special,
        ]);
        return response_success($item);
    }

    public function update_image($request,$item)
    {
        if ((new MediaService)->update_model_image($request,$item,'image','implements/implements')){

            return response_success($item);
        }
        return response_custom_error('image file update error');
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    public function forms($request,$item)
    {
        $item->forms()->delete();
        if (is_array($request->forms)){
            foreach ($request->forms as $form){
                $item->forms()->create([
                    'form_id' => $form,
                ]);
            }
        }
        return response_success(true,'item forms updated');
    }


    public function categories_index()
    {
        $data = Implement_Category::orderBy('num','ASC')->withCount('implements');
        return response_success(ImplementCategoriesShortResource::collection($data->get()));
    }

    public function categories_store($request)
    {
        $image=null;
        if ($request->file('image')){
            $image = (new MediaService())->store_image($request->file('image'),'implements/categories');
        }
        $item = Implement_Category::create([
            'name' => $request->name,
            'num' => $request->num,
            'image' => $image,
            'description' => $request->description,
        ]);
        return response_success($item);
    }

    public function categories_update($request,$item)
    {
        $item->update([
            'name' => $request->name,
            'num' => $request->num,
            'description' => $request->description,
        ]);
        return response_success($item);
    }

    public function categories_update_image($request,$item)
    {
        if ((new MediaService)->update_model_image($request,$item,'image','implements/categories')){

            return response_success($item);
        }
        return response_custom_error('image file update error');
    }

    public function categories_delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }



    public function forms_index()
    {
        return response_success(Form::orderByDesc('id')->get());
    }

    public function forms_store($request)
    {

        $item = Form::create([
            'name' => $request->name,
        ]);
        return response_success($item);
    }

    public function forms_update($request,$item)
    {
        $item->update([
            'name' => $request->name,
        ]);
        return response_success($item);
    }

    public function forms_delete($item)
    {
        $item->implements()->delete();
        $item->delete();
        return response_success(true,'item deleted success');

    }

    public function requests_index()
    {
        return response_success(Implement_Request::with('user')->orderByDesc('id')->get());

    }

    public function requests_delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');
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

    public function implement_specials($request)
    {
        if (!$request->filled('count')){
            $request->merge(['count' => 2]);
        }
        $data = Implement::where('is_special',true)->inRandomOrder()->take($request->count);
        $data->select(['id','name','image','long_description']);
        return response_success($data->get());

    }


}
