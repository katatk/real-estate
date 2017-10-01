<?php 
session_start();
$title = "User Account";
include 'user-header.php';

if (!$_SESSION['logged_in']) {
  header('Location: login.php');
  die(); 
} 

/* get the logged in user's email address and account type */

?>

<div class="container">

    <main class="col-xs-12 pt-3" role="main">
        <h1>Dashboard</h1>

        <span class="welcome">Hi, <?php echo $_SESSION['first_name']; ?></span>

        <h2>Wishlist</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>City</th>
                        <th>Price</th>
                        <th>Address</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- fetch properties from the database -->
                    <?php

                    include('config.php');
                    /* get all the rows of the property ID where the user email matches the user that's logged in */
                    "SELECT * FROM properties INNER JOIN user_wishlist ON user_wishlist.Property_ID WHERE user_wishlist.Email_Address=?";
                    
                    "SELECT user_wishlist.Property_ID
                    FROM user_wishlist WHERE Email_Address=?
                    INNER JOIN properties ON user_wishlist.Property_ID=properties.Property_ID";
                    
                   /* $stmt = $db->prepare("SELECT Property_ID FROM user_wishlist WHERE Email_Address=?");
                    $stmt->bind_param('s', $_SESSION['email_address']);    

                    // running insert statement
                    if ($stmt->execute() === TRUE) {
                        echo "Email checked successfully";
                    } else {
                        echo "Error: " . $db->error;
                    }

                    // bind result variables
                    $stmt->bind_result($stored_property_id);

                    // fetch value
                    $stmt->fetch();

                    // close statement
                    $stmt->close();

                    // close the connection
                    $db->close();*/

                    $sql = "SELECT * FROM user_wishlist WHERE Email_Address =  ORDER BY Property_ID";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>".$row["Type"]."</td><td>".$row["City"]."</td><td>".$row["Price"]."</td><td>".$row["Address"]."</td><td>".$row["Description"]."</td></tr>";
                        }
                    } else {
                        echo "0 results";
                    }

                    mysqli_close($db);
                    ?>
                </tbody>
            </table>
        </div>

    </main>
</div>
<?php include 'footer.php'; ?>
