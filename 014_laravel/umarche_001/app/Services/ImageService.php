<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService{

    public static function upload($imageFile,$folderName){
        
       // Storage::putFile('public/'.$folderName.'/',$imageFile);

        $filename=uniqid(rand().'_');
        $extension=$imageFile->extension();
        $fileNameToStore=$filename.'.'.$extension;

        $resizedImage=InterventionImage::make($imageFile)->resize(1920,1080)->encode();


        Storage::put('public/'.$folderName.'/'.$fileNameToStore,$resizedImage);
        
        return $fileNameToStore;
    }
}