<?php

// checks the file's MIME type, if it is a jpg or png
function validateMimeType($file_name){
    // array of acceptable MIME types
    $mime_types = [
        'image/png',
        'image/jpeg'
    ];
    
    // determines MIME type
    $type = mime_content_type($file_name);
    
    // check if MIME type is in array of acceptable types
    return in_array($type, $mime_types, true);
};

// function to store the user uploaded file, creates new path to uploaded image
function storeUploadedFile($tmpFilePath){
    
    // gets the image type, reads first few bytes of image and returns int that represents jpg or png
    $imageTypeInt = exif_imagetype($tmpFilePath);
    
    // takes int and gets image extension
    $extension = image_type_to_extension($imageTypeInt);
    
    // gets the target directory for upload
    $target_dir = "images/properties/";
    
    // generates unique name for file based on microseconds of upload time
    // second param makes it more unique adds additional characters on end of returned value
    //eg "/images/properties/8872791982.jpg"
    $newImagePath = $target_dir . uniqid("prop", true) . $extension;
   
    // takes current image path (in tmp folder) and puts it in new location newImagePath
    move_uploaded_file($tmpFilePath, $newImagePath);
    
    return $newImagePath;
}

