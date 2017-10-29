<?php
session_start();

// user can only access form-login via the POST method, not GET (typing directly into the address bar)
if (empty($_POST['submit'])) {
  header('Location: ../login');
  die(); 
} 

include_once '../inc/validation.php';
include_once '../inc/config.php';

// set the submit messages
$msg_fail = 'One or more fields have an error.';
$msg_empty = 'Please fill in all required fields.';
$msg_unknown = 'Something went wrong.';

// set POST values to variables
$email = $_POST['email'];
$password = $_POST['password'];

// set the placeholders
$_SESSION['placeholder_email'] = $email;
$_SESSION['placeholder_password'] = $password;

// if no fields have been filled out
if (empty($email) && empty($password)) {
     $_SESSION['alertMessage'] = $msg_empty;
     header("Location: ../login");
     die();
} 


// if everything is valid then set valid_form to true
$valid_form = validateEmail($email) && validatePassword($password);

if ($valid_form) {
    
    $sql = "SELECT email_address, password, role, first_name FROM users WHERE email_address=?";
    
    // check if email exists in database
    $stmt = $db->prepare($sql);
    
    $stmt->bind_param('s', $email);    

      // running insert statement
        if ($stmt->execute() === true) {
            // echo "Email checked successfully";
        } else {
            echo "Error: " . $db->error;
        }

        // bind result variables
        $stmt->bind_result($stored_email, $stored_password, $stored_role, $stored_first_name);
 
        // fetch value
        $stmt->fetch();
        
        // close statement
        $stmt->close();
        

    // if email address does not exist, redirect back to login page with an error message
    if ($stored_email == null) {
         $_SESSION['error_email'] = "That email address does not exist";
         $_SESSION['alertMessage'] = $msg_fail;
         header("Location: ../login");
         die();
    }
    
    // check the password in the database against the user submitted password
    $correct_password = password_verify($password, $stored_password); 
    
    // if matching, send user to welcome page
    if ($correct_password) {
        /* get info about the logged in user to use elsewhere */
         $_SESSION['first_name'] = $stored_first_name;
         $_SESSION['role'] = $stored_role;
         $_SESSION['email_address'] = $stored_email;
         $_SESSION['logged_in'] = true;
        // unset session placeholders
       
        unset($_SESSION['placeholder_first_name']);
        unset($_SESSION['placeholder_email']);
        unset($_SESSION['placeholder_password']);
        unset($_SESSION['placeholder_password_confirm']);
      
        if ($stored_role == "User") {
            $_SESSION['role'] = "User";
            header("Location: ../wishlist");
            die();
        }
        
        $_SESSION['role'] = "Agent";
        header("Location: ../dashboard");
        die();
        
    } else {
         $_SESSION['error_password'] = "Your password is incorrect";
         $_SESSION['alertMessage'] = $msg_fail;
         header("Location: ../login");
         die();
    }

} else {
    $_SESSION['alertMessage'] = $msg_fail;
    header("Location: ../login");
    die();
}
?>
