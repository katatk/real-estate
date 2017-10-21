<?php
session_start();

include 'validation.php';

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
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password-confirm'];
// returns true or false
$role = isset($_POST['role']);

// set the placeholders
$_SESSION['placeholder_first_name'] = $first_name;
$_SESSION['placeholder_email'] = $email;
$_SESSION['placeholder_password'] = $password;
$_SESSION['placeholder_password_confirm'] = $password_confirm;

// if no fields have been filled out
if (empty($first_name) && empty($email) && empty($password) && empty($password_confirm)) {
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

// if agent checkbox is checked, returns true, user is an agent
if ($role) {
    $role = "Agent";
} else {
     $role = "User";
}

// if everything is valid then set valid_form to true
$valid_form = validateName($first_name) && validateEmail($email) && validatePassword($password) &&  passwordsMatch($password, $password_confirm);



// if passwords match, hash password otherwise return false
if (passwordsMatch($password, $password_confirm)){ 
        // cost represents how many times you run the hash function, will take longer to crack the higher the cost but also becomes slower
    $hashed_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
}
    
if ($valid_form) {
    
    // create the connection
    include('config.php');

     // create query to check if email already exists in the database
    $stmt = $db->prepare("SELECT Email_Address FROM users WHERE Email_Address=?");
    // bind parameters
    $stmt->bind_param('s', $email); 

     // running insert statement
    if ($stmt->execute() === FALSE) {
        echo "Error: " . $db->error;
        die();
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
    $stmt = $db->prepare("INSERT INTO users (Email_Address, First_Name, Password, Role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $email, $first_name, $hashed_password, $role);

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

    // take user to login page
    $_SESSION['alertMessage'] = "Account created successfully";
    header("Location: login.php");
    die();

} else {
    $_SESSION['alertMessage'] = $msg_fail;
    header("Location: register.php");
    die();
}
