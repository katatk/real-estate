<?php
session_start();

// only logged in users can run this script
if (!$_SESSION['logged_in']) {
$_SESSION['alertMessage'] = 'You must be logged in to logout.';
  header('Location: ../login');
  die(); 
}

unset($_SESSION['logged_in']);

$_SESSION['alertMessage'] = "You have been logged out";

header("Location: ../login");
die();
?>