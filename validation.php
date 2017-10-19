<?php
// validation functions

// checks if a field is empty
// empty() checks for an empty string
function isEmpty($param_value, $param_error) {
    if(empty($param_value)) {
        return $param_error; 
        
    } else {
        return null;
    }
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
function passwordsMatch($param_password, $param_password_confirm){
  $valid_password_confirm = false;
    if (!empty($param_password) && (!empty($param_password_confirm))) {
        if ($param_password_confirm === $param_password) {
            $valid_password_confirm = true;
            // if passwords match, hash the original password
            // cost represents how many times you run the hash function will take longer to crack the higher the cost
            $hashed_password = password_hash($param_password, PASSWORD_DEFAULT, ['cost' => 12]);
            
        } else {
            $_SESSION['error_password_confirm'] = "Passwords do not match";
        } 
        return  $valid_password_confirm;
    }
}

