<?php 
session_start();

include_once 'config.php';

if (isset($_SESSION['logged_in']) && $_SESSION['role'] == "User") {

    // if id has been set, edit the current listing, else we are adding a new entry
    if (isset($_GET['id'])) {
        
    $id = $_GET['id'];
    $email =  $_SESSION['email_address'];
    
    $sql = "SELECT Property_ID FROM user_wishlist WHERE Email_Address=?";
   
     // create query to check if listing is already in wishlist
    $stmt = $db->prepare($sql);
    // bind parameters
    $stmt->bind_param('s', $email);
 
     // running insert statement
    if ($stmt->execute() === FALSE) {
        echo "Error: " . $db->error;
        die();
    }
 
    // bind result variables
    $stmt->bind_result($stored_id);
 
    // fetch value
    $stmt->fetch();
 
    // close statement
    $stmt->close();
 
    // check id is unique
    if ($stored_id === $id) {
 
    $_SESSION['alertMessage'] = "This property is already added to your Wishlist";
 
    // go back to the wishlist page
    header("Location: wishlist");
    die();
    } elseif {


    $sql = "INSERT INTO user_wishlist SET Property_ID=?, Email_Address=?";
        
    // creates the statement, prepare removes SQL syntax to prevent SQL injection attacks eg someone typing 'DROP table' into a field
    $stmt = $db->prepare($sql);
    $stmt->bind_param('is', $id, $email);

    // running insert statement
    if ($stmt->execute() === false) {
       echo "Error: " . $db->error;
        die();
    }

    // close statement
    $stmt->close();
                      
    // show a success message
     $_SESSION['alertMessage'] = "Property added to wishlist";
        
    header("Location: wishlist");
    die();}
    
    
    } 
} elseif (isset($_SESSION['logged_in']) && $_SESSION['role'] == "Agent") {
    // show a success message
    $_SESSION['alertMessage'] = "You must be logged in as a user to view your wishlist.";
    header("Location: login");
    die();
    
} elseif (!isset($_SESSION['logged_in'])) {
    // show a success message
    $_SESSION['alertMessage'] = "Please log in to add this property to your wishlist.";
    header("Location: login");
    die();
}