<?php

$target_dir = "images/properties/";
$target_file = $target_dir . basename($_FILES["img-upload"]["name"]);


function mime_content_type($img-upload){
    $mime_types = array(
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
    );
                
};