<?php
namespace App\Services\MediaServices;

use App\Models\Media;
use App\Services\UploadServices\UploadImageService;
use Illuminate\Support\Facades\Storage;

class MediaService{

    public function store_image_resize($file,$width,$height,$folder=null,$description=null): string
    {
        $title = $file->getClientOriginalName();
        $saved_file = (new UploadImageService())->upload_resize_public($file,'images/'.$folder,$width,$height);
        $url = Storage::url($saved_file);
        Media::create([
            'title' => $title,
            'url' => $url,
            'file' => $saved_file,
            'description' => $description,
        ]);
        return $url;
    }

    public function store_image($file,$folder=null,$description=null): string
    {
        $title = $file->getClientOriginalName();
        $saved_file = (new UploadImageService())->upload_public($file,'images/'.$folder);
        $url = asset(Storage::url($saved_file));
        Media::create([
            'admin_id' => auth('admin')->id(),
            'title' => $title,
            'url' => $url,
            'file' => $saved_file,
            'description' => $description,
        ]);
        return $url;
    }

    public function update_model_image($request,$model,$column,$folder): bool
    {
        if ($request->hasFile($column)){
            $file = $request->file($column);
            $image = $this->store_image($file,$folder);
            $model->update([$column => $image]);
        }else{
            $model->update([$column => null]);
        }
        return true;
    }

    public function update_auth_user_profile($request)
    {
        $image=null;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $image = $this->store_image($file,'users/profile');
        }
        auth('users')->user()->update(['profile' => $image]);
        return $image;
    }




}
