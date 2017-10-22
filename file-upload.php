<?php

function storeUploadedFile($tmpFilePath){
    
    // gets the image type, returns int that represents jpg or png
    $imageTypeInt = exif_imagetype($tmpFilePath);
    
    // takes int and gets image extension
    $extension = image_type_to_extension($imageTypeInt);
    
    $target_dir = "images/properties/";
    
    // generates unique name for file based on microseconds of upload time
    // second param makes it more unique adds additional stuff on end of returned value
    $newImagePath = $target_dir . uniqid("prop", true) . $extension;
    
   
    // takes current image path (in tmp folder) and puts it in new location newImagePath
    move_uploaded_file ($tmpFilePath, $newImagePath);
    
    return $newImagePath;
}

function validateMimeType($file_name){
    $mime_types = [
        'image/png',
        'image/jpeg'
    ];
    
    $type = mime_content_type($file_name);
    
    return in_array($type, $mime_types, true);
};