<?php

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