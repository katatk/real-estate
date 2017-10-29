<?php
session_start();

// only admins can run this script
if (!$_SESSION['logged_in'] || $_SESSION['role'] == 'User') {
$_SESSION['alertMessage'] = 'You do not have access to this page, you must be logged in as admin.';
  header('Location: ../login');
  die(); 
}

// user can only access process/register-processing via the POST method, not GET (typing directly into the address bar)

if (empty($_POST['submit'])) {
  header('Location: ../add-property');
  die(); 
} 

include_once '../inc/validation.php';
include_once '../inc/file-upload.php';
include_once '../inc/config.php';

// set the submit messages
$msg_fail = 'One or more fields have an error.';
$msg_empty = 'Please fill in all required fields.';
$msg_success_add = 'Property successfully added.';

// set POST values to variables
$img_url = $_POST['img-url'];
$img_upload = $_FILES['img-upload']['tmp_name'];
$title = $_POST['title'];
$type = $_POST['type'];
$city = $_POST['city'];
$price = $_POST['price'];
$address = $_POST['address'];
$description = $_POST['description'];


// redirect url if no post id is set (not editing an existing property)
$redirect_url = '../add-property';

// edit redirect url
if(!empty($_POST['id'])) {
    $redirect_url .= '?id=' . $_POST['id'];
}

// set the placeholders
$_SESSION['img_url'] = $img_url;
$_SESSION['img_upload'] = $_FILES['img-upload']['name'];
$_SESSION['title'] = $title;
$_SESSION['type'] = $type;
$_SESSION['city'] = $city;
$_SESSION['price'] = $price;
$_SESSION['address'] = $address;
$_SESSION['description'] = $description;

// if no fields have been filled out
if ((empty($img_url) || empty($img_upload)) && empty($title) && empty($type) && empty($city) && empty($price) && empty($address) && empty($description)) {
     $_SESSION['alertMessage'] = $msg_empty;
     header("Location: ../" . $redirect_url);
     die();
}

$empty_form = true;

// set the error messages if any fields are empty
if (empty($img_url) && empty($img_upload)) {
   $_SESSION['error_img'] = "Please upload an image or enter a url";
    $empty_form = false;
}
if (!empty($img_url) && !empty($img_upload)) {
    $_SESSION['error_img'] = "Please choose either an image or a url";
     $empty_form = false;
}
if (empty($title)) {
    $_SESSION['error_title'] = "Please enter a title";
    $empty_form = false;
}
if (empty($price)) {
    $_SESSION['error_price'] = "Please enter a price (numbers only)";
    $empty_form = false;
}
if (empty($address)) {
   $_SESSION['error_address'] = "Please enter an address";
    $empty_form = false;
}
if (empty($description)) {
   $_SESSION['error_description'] = "Please enter a description";
    $empty_form = false;
}

// if any fields are empty
if (!$empty_form) {
    $_SESSION['alertMessage'] = $msg_fail;
     header("Location: " . $redirect_url);
    die();
}

// validate the data
$valid_form = true;

// if an image has been uploaded (not empty) then validate it
if (!empty($img_upload)) {
    
    validateMimeType($img_upload);
    
    if (validateMimeType($img_upload) == false) {
       $_SESSION['error_img'] = "Please upload a valid image type: PNG or JPG";
       $valid_form = false;
    } else {
        $img_url = storeUploadedFile($img_upload);
    }
}

if (!$valid_form) {
     $_SESSION['alertMessage'] = $msg_fail;
     header("Location: " . $redirect_url);
    die();
}

// if id has been set, edit the current listing, else we are adding a new entry
// id is set in hidden form field

if (!empty($_POST['id'])) {
    
    $id = $_POST['id'];
    
    $sql = "UPDATE properties SET image_url=?, title=?, type=?, city=?, price=?, address=?, description=? WHERE property_id=?";

    // creates the statement, prepare removes SQL syntax to prevent SQL injection attacks eg someone typing 'DROP table' into a field
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssissi', $img_url, $title, $type, $city, $price, $address, $description, $id);

    // running insert statement
    if ($stmt->execute() === false) {
       echo "Error: " . $db->error;
        die();
    }

    // close statement
    $stmt->close();

    // show a success message
     $_SESSION['alertMessage'] = "Property 00" . $id . " successfully edited.";

    header("Location: " . $redirect_url);
    die();
    
} else {
    
    $sql = "INSERT INTO properties (image_url, title, type, city, price, address, description) VALUES (?, ?, ?, ?, ?, ?, ?)";  

    // creates the statement, prepare removes SQL syntax to prevent SQL injection attacks eg someone typing 'DROP table' into a field
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssiss', $img_url, $title, $type, $city, $price, $address, $description);

    // running insert statement
    if ($stmt->execute() === false) {
        echo "Error: " . $db->error;
        die();
    }

    // close statement
    $stmt->close();

    // show a success message
     $_SESSION['alertMessage'] = $msg_success_add;
    header("Location: " . $redirect_url);
    die();
}  


