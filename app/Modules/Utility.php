<?php

namespace App\Modules;

class Utility
{   
    public static function uploadFile($file,$folder='uploads'){
        $filename = time().'_'.$file->getClientOriginalName();
        $filePath = $file->storeAs($folder,$filename,'public');
        return '/storage/'.$filePath;
    }
}
