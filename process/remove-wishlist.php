<?php
session_start();

// only logged in users can run this script
if (!$_SESSION['logged_in'] || $_SESSION['role'] != 'User') {
$_SESSION['alertMessage'] = 'You do not have access to this page, you must be logged in as a user.';
  header('Location: ../login');
  die(); 
}


include_once '../inc/config.php';

if (isset($_GET['id'])) {
   
    $id = $_GET['id'];
        
    $sql = "DELETE FROM user_wishlist WHERE property_id=?";
      
    $stmt = $db->prepare($sql);
      
    $stmt->bind_param('i', $id);

    // running insert statement
    if ($stmt->execute() === false) {
        echo "Error: " . $db->error;
    }

    // close statement
    $stmt->close();
        
    // show a success message
    $_SESSION['alertMessage'] = "Property removed from Wishlist";
    header("Location: ../wishlist");
    die();
  }

$_SESSION['alertMessage'] = "Something went wrong";
header("Location: ../wishlist");
die();
