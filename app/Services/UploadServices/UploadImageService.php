<?php
namespace App\Services\UploadServices;

use Intervention\Image\Facades\Image;

class UploadImageService{

    public function upload_resize_public($image,$dir=null,$width=null,$height=null): string
    {
        $image = Image::make($image);
        $file_name = time().'.'.$image->extension;
        $url = 'app/public/'.$dir.'/'.$file_name;
        $image->resize($width,$height)->save(storage_path($url),'100');
        return $url;
    }



}
