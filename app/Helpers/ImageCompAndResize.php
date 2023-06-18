<?php

// namespace App\Helpers;

// // use Intervention\Image\Facades\Image;
// use Intervention\Image\Image;
use Intervention\Image\Facades\Image;

function resizeAndCompress($imagePath, $width, $height)
    {
        $resizedImage = Image::make($imagePath,false);


        $resizedImage->fit($width,  $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $resizedImage->crop($width, $height);
        
        return $resizedImage;
    }


function msh($asd,$qwe){
    return "fuck laravel".$asd.$qwe;
}