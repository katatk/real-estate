<?php
session_start();
$_SESSION['logged_in'] = false;
$_SESSION['alertMessage'] = "You have been logged out";
header("Location: login");
die();
?>