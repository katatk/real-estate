<?php
session_start();

// only admins can run this script
if (!$_SESSION['logged_in'] || $_SESSION['role'] == 'User') {
$_SESSION['alertMessage'] = 'You do not have access to this page, you must be logged in as admin.';
  header('Location: ../login');
  die(); 
}

// get parameter must be set to view this page
if (!isset($_GET['id'])) {
  header('Location: ../dashboard');
  die(); 
} 

include_once '../inc/config.php';

if (isset($_GET['id'])) {
   
    $id = $_GET['id'];
        
    $sql = "DELETE FROM properties WHERE property_id=?";
      
    $stmt = $db->prepare($sql);
      
    $stmt->bind_param('i', $id);

    // running insert statement
    if ($stmt->execute() === false) {
        echo "Error: " . $db->error;
    }

    // close statement
    $stmt->close();
        
    // show a success message
    $_SESSION['alertMessage'] = "Property 00". $id . " deleted";
    header("Location: ../dashboard");
    die();
  }

$_SESSION['alertMessage'] = "Something went wrong";
header("Location: ../dashboard");
die();