<?php

namespace App\Modules;

use Illuminate\Support\Facades\File;

class Utility
{   
    public static function uploadFile($file,$folder='uploads'){
        $filename = time().'_'.$file->getClientOriginalName();
        $filePath = $file->storeAs($folder,$filename,'public');
        return '/storage/'.$filePath;
    }

    public static function deleteFile($filePath){
        if(File::exists(public_path($filePath))){
            unlink(public_path($filePath));
        }
    }
}
