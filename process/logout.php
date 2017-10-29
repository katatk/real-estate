<?php
session_start();

unset($_SESSION['logged_in']);

$_SESSION['alertMessage'] = "You have been logged out";

header("Location: ../login");
die();
?>