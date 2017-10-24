<?php
session_start();

include_once 'config.php';

if (isset($_GET['id'])) {
   
    $id = $_GET['id'];
        
    $sql = "DELETE FROM user_wishlist WHERE Property_ID=?";
      
    $stmt = $db->prepare($sql);
      
    $stmt->bind_param('i', $id);

    // running insert statement
    if ($stmt->execute() === false) {
        echo "Error: " . $db->error;
    }

    // close statement
    $stmt->close();
        
    // show a success message
    $_SESSION['alertMessage'] = "Property 00". $id . " removed from Wishlist";
    header("Location: wishlist");
    die();
  }

$_SESSION['alertMessage'] = "Something went wrong";
header("Location: wishlist");
die();
