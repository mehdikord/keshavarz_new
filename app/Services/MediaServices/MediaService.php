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




}
