<?php
namespace App\Repository\Profile;



use App\Interfaces\Profile\ProfileInterface;
use App\Models\Implement_Request;
use App\Services\MediaServices\MediaService;
use Illuminate\Support\Facades\Storage;
use Morilog\Jalali\Jalalian;

class ProfileRepository implements ProfileInterface
{
    public function manage_me()
    {
        return response_success(auth('admin')->user(),'management profile');
    }

    public function user_me()
    {
        $user = auth('users')->user();
        $user->load('province')->load('city');
        return response_success($user);
    }

    public function user_update($request)
    {
        $user = auth('users')->user();
        $user->update([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'national_code' => $request->national_code,
            'bio' => $request->bio,
        ]);
        $user->load('province')->load('city');
        return response_success($user);

    }

    public function user_update_image($request)
    {
        $image = (new MediaService())->update_auth_user_profile($request);
        return response_success($image);
    }

    public function range()
    {
        return response_success(auth()->user()->select(['search_range','search_location'])->first());
    }

    public function range_update($request)
    {
        auth()->user()->update([
            'search_range' => $request->range,
            'search_location' => json_encode($request->location, JSON_THROW_ON_ERROR),
        ]);
        return response_success($this->range());
    }

    public function implement()
    {

        return response_success(auth('users')->user()->implements()->with('forms')->with('implement')->get());
    }

    public function implement_update($request)
    {
        if (auth('users')->user()->implements()->where('implement_id',$request->implement_id)->exists()){
            return response_custom_error('این دستگاه قبلا اضافه شده است');
        }
        $implement = auth('users')->user()->implements()->create([
            'implement_id' => $request->implement_id,
            'price' => $request->price
        ]);
        if ($request->forms && is_array($request->forms)){
            foreach ($request->forms as $form){
                if (!empty($form['data'])){

                    $implement->forms()->create([
                        'form_id' => $form['id'],
                        'data' => $form['data'],
                    ]);

                }
            }
        }
        return response_success(auth('users')->user()->implements()->where('implement_id',$request->implement_id)->with('forms')->first());
    }

    public function implement_request($request)
    {
        $image = (new MediaService())->implement_request_image($request);
        Implement_Request::create([
            'user_id' => auth()->id(),
            'type'=>$request->type,
            'name'=>$request->name,
            'description'=>$request->description,
            'image' => $image
        ]);
        return response_success('','اطلاعات شما باموفقیت ثبت گردید. با تشکر از شما');
    }

    public function implement_edit($item,$request)
    {
        $item->update([
            'price' => $request->price
        ]);
        return response_success($item);
    }

    public function implement_delete($item)
    {
        $item->delete();
        return response_success(true);
    }

    public function index_gallery()
    {
        return auth()->user()->gallery;
    }

    public function store_gallery($request)
    {

        $image = (new MediaService())->store_image($request->file('image'),'users/gallery');


        return auth()->user()->gallery()->create([
            'file_path' => $image,
            'file' => $image,
            'type' => 'image',
        ]);
    }

    public function delete_gallery($item)
    {
        if ($item->file_path){
            Storage::delete($item->file_path);
        }
        $item->delete();
        return true;
    }

    public function get_days()
    {
        return response_success(auth('users')->user()->days);
    }

    public function store_days($request)
    {

        if ($request->filled('days') && is_array($request->days)){
            foreach ($request->days as $day){
                $date = Jalalian::fromFormat('Y/m/d',$day)->toCarbon();
                auth('users')->user()->days()->updateOrCreate([
                    'day'=>$date
                ]);
            }

        }
        return auth('users')->user()->days;

    }

    public function delete_days($item)
    {
        if ($item->user_id == auth('users')->id()){
            $item->delete();
            return response_success([],'تاریخ با موفقیت حذف شد');
        }
        return response_custom_error('error');
    }



}
