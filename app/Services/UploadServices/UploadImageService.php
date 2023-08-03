<?php
namespace App\Services\UploadServices;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadImageService{

    public function upload_resize_public($image,$dir=null,$width=null,$height=null): string
    {
        $new_image = Image::make($image);
        $file_name = time().'.'.$new_image->extension;
        $url = 'public/'.$dir.'/'.$file_name;
        $new_image->resize($width,$height)->save(storage_path($url),'100');
        return $url;
    }

    public function upload_public($image,$dir=null): string
    {
        return Storage::put('public/'.$dir,$image,'public');
    }



}
