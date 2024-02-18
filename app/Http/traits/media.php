<?php

namespace App\Http\traits;

trait media {
    public function uploadPhoto($cover_image,$folder)
    {
        $photoName=uniqid(). '.' .$cover_image->extension();
        $cover_image->move(public_path('img/'.$folder),$photoName);
        return $photoName;
        
    }
    public function deletePhoto($photoPath)
    {
       //bt3mel check w b3den tms7o
       if(file_exists($photoPath)){
        unlink($photoPath);
        return true;
       }
       return false;

    }
}