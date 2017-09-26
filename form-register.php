<?php
session_start();

// user can only access form-register via the POST method, not GET (typing directly into the address bar)
if (empty($_POST['submit'])) {
  header('Location: register.php');
  die(); 
} 

// set the submit messages
$msg_fail = 'One or more fields have an error.';
$msg_empty = 'Please fill in all required fields.';

// set POST values to variables
$first_name = $_POST['firstname'];
$last_name = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password-confirm'];

// set the placeholders
$_SESSION['placeholder_first_name'] = $first_name;
$_SESSION['placeholder_last_name'] = $last_name;
$_SESSION['placeholder_email'] = $email;
$_SESSION['placeholder_password'] = $password;
$_SESSION['placeholder_password_confirm'] = $password_confirm;

// if no fields have been filled out
if (empty($first_name) && empty($last_name) && empty($email) && empty($password) && empty($password_confirm)) {
     $_SESSION['alertMessage'] = $msg_empty;
     header("Location: register.php");
     die();
} 

// function that removes white space, slashes and HTML special characters - for displaying data, stops scripts being sent to user, NOT for preventing SQL injection
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

    // if fields have been filled out, go through each and validate
    // validate first name
    $valid_first_name = false;
    if (!empty($first_name)) {
       if (strlen($first_name) >= 2) {
            $valid_first_name = true;
            $first_name = clean_input($first_name);
        } else {
            $_SESSION['error_first_name'] = "First name is too short, please enter at least 2 characters";
        }
    } else {
        $_SESSION['error_first_name'] = "Please enter a first name";
        }

    // validate last name
    $valid_last_name = false;
    if (!empty($last_name)) {
        if (strlen($last_name) >= 2) {
            $valid_last_name = true;
            $last_name = clean_input($last_name);
        } else {
         $_SESSION['error_last_name'] = "Last name is too short, please enter at least 2 characters";
        }
    } else {
        $_SESSION['error_last_name'] = "Please enter a last name";
        }
    
    // validate email
    // filter that checks if valid email address
    $valid_email = false;
     if (!empty($email)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $valid_email = true;
            $email = clean_input($email);
        } else {
           $_SESSION['error_email'] = "Email address is invalid";
        }
     } else {
        $_SESSION['error_email'] = "Please enter an email address";
        }
    
    // validate password
    $valid_password = false;
     if (!empty($password)) {
        if (strlen($password) >= 8) {
            $valid_password = true;
        } else {
            $_SESSION['error_password'] = "Password is too short, please enter at least 8 characters";
        }
     } else {
        $_SESSION['error_password'] = "Please enter a password";
        }


    $valid_password_confirm = false;
    if (!empty($password_confirm) && (!empty($password))) {
        if ($password_confirm === $password) {
            $valid_password_confirm = true;
            // if passwords match, hash the original password
            // cost represents how many times you run the hash function will take longer to crack the higher the cost
            $hashed_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
            
        } else {
            $_SESSION['error_password_confirm'] = "Passwords do not match";
        } 
    }

    // if everything is valid then set valid_form to true
    $valid_form = $valid_first_name && $valid_last_name && $valid_email && $valid_password &&  $valid_password_confirm;
    
    if ($valid_form) {
        // create the connection
        include('config.php');
        
         // create query to check if email already exists in the database
        $stmt = $db->prepare("SELECT email FROM students WHERE email=?");
        // bind parameters
        $stmt->bind_param('s', $email); 
        
         // running insert statement
        if ($stmt->execute() === TRUE) {
            echo "Email checked successfully";
        } else {
            echo "Error: " . $db->error;
        }

        // bind result variables
        $stmt->bind_result($stored_email);

        // fetch value
        $stmt->fetch();
        
        // close statement
        $stmt->close();
        
    // check email is unique
    if ($stored_email === $email) {

    $_SESSION['error_email'] = "That email address is already taken, please use another or <a href='login'>login here</a>";
    $_SESSION['alertMessage'] = $msg_fail;
   
    // go back to the register page
    header("Location: register.php");
    die();
    }
        
    // if data is valid, insert into database
    // creates the statement, prepare removes SQL syntax to prevent SQL injection attacks eg someone typing 'DROP table students' into a field
    $stmt = $db->prepare("INSERT INTO students (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $first_name, $last_name, $email, $hashed_password);

    // running insert statement
    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $db->error;
    }

    // close statement
    $stmt->close();
    // close connection
    $db->close();    
        
    // send confirmation email
    $subject = 'Student Registration';
        
    $body = "You have been registered as a student - your parents will be so proud. Here are your login details:\n";
    $body .= "Username: $email\n";
    $body .= "Password: $password\n";
    $headers = "From: localhost";

    if(mail($email,$subject,$body,$headers)){
        $emailDataLog = "To: $email\n$subject\nbody: $body";
        $log = "Email successfully sent:\n$emailDataLog";
    } else {
        $log = "email not sent.";
    }

     error_log($log."\n");
        
    // take user to login page
    header("Location: login.php");
    die();
        
} else {
    $_SESSION['alertMessage'] = $msg_fail;
    header("Location: register.php");
    die();
}