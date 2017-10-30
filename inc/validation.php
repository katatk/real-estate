<?php
// validation functions

// function that removes white space, slashes and HTML special characters - for displaying data, stops scripts being sent to user, NOT for preventing SQL injection
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// checks for a valid email address
function validateEmail($param_email) {
   $valid_email = false; 
    if (!empty($param_email)) {
        $email = clean_input($param_email);
        if (filter_var($param_email, FILTER_VALIDATE_EMAIL)) {
            $valid_email = true;
        } else {
               $_SESSION['error_email'] = "Email address is invalid";
            }
         } else {
            $_SESSION['error_email'] = "Please enter an email address";
            }
    return $valid_email;
}

// validate a name (more than 2 characters)
function validateName($param_name){
    $valid_name = false;
     if (!empty($param_name)) {
        $first_name = clean_input($param_name);
        if (strlen($param_name) >= 2) {
            $valid_name = true;

        } else {
            $_SESSION['error_first_name'] = "First name is too short, please enter at least 2 characters";
        }
    } else {
        $_SESSION['error_first_name'] = "Please enter a first name";
    }
    return $valid_name;
}

// validate password
function validatePassword($param_password) {
     $valid_password = false;
     if (!empty($param_password)) {
        if (strlen($param_password) >= 8) {
            $valid_password = true;
        } else {
            $_SESSION['error_password'] = "Password is too short, please enter at least 8 characters";
        }
     } else {
        $_SESSION['error_password'] = "Please enter a password";
        }
    return $valid_password;
}

// checks if passwords match
function passwordsMatch($param_password, $param_password_confirm) {
    $passwords_match = false;
    if (!empty($param_password) && (!empty($param_password_confirm))) {
        if ($param_password_confirm === $param_password) {
            $passwords_match = true;
            
        } else {
            $_SESSION['error_password_confirm'] = "Passwords do not match";
        } 
        return $passwords_match;
    }
}
