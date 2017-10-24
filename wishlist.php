<?php 
session_start();
$title = "Wishlist";
include_once 'header.php';

if (!$_SESSION['logged_in']) {
  header('Location: login');
  die(); 
} 

?>
<div class="row">
                <div class="col-12">
        <h1>Wishlist</h1>

        <p class="welcome">Hi, <?php echo $_SESSION['first_name']; ?></p>
            
             <?php 
            if (isset($_SESSION['alertMessage'])) { 
            echo "<p>".$_SESSION['alertMessage']."</p>"; 
            unset($_SESSION['alertMessage']);
            }; 
            ?>

            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>City</th>
                        <th>Price</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Remove From Wishlist</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- fetch properties from the database -->
                    <?php
                    /* get all the rows of the property ID where the user email matches the user that's logged in */
                   
                    $sql = "SELECT properties.Property_ID, properties.Image_URL, properties.Title, properties.Type, properties.City, properties.Price, properties.Address, properties.Description FROM user_wishlist INNER JOIN properties
                    ON user_wishlist.Property_ID = properties.Property_ID
                    WHERE user_wishlist.Email_Address=?";
                    
                    $stmt = $db->prepare($sql);
                    
                    if ($stmt === false) {
                    printf("Errormessage: %s\n", $db->error);
                    die();
                    }
                    
                    $stmt->bind_param('s', $_SESSION['email_address']);  
                    
                    $stmt->execute();
                    
                    $results = $stmt->get_result();
                    
                    if ($results->num_rows > 0) {
                        // output data of each row
                        while($row = $results->fetch_assoc()) {
                            echo "<tr><td><img src='".$row["Image_URL"]."' class='thumbnail'></td><td>".$row["Title"]."</td><td>".$row["Type"]."</td><td>".$row["City"]."</td><td>$" . number_format($row["Price"])."</td><td>".$row["Address"]."</td><td>".$row["Description"]."</td><td><form method='get' action='remove-wishlist.php' enctype='multipart/form-data'><a href='remove-wishlist.php?id=".$row["Property_ID"]."' class='btn btn-danger'>Remove</a></form></td></tr>";
                        }
                    } else {
                        echo "You have no properties saved to your wishlist";
                    }
                    
                    // close statement
                    $stmt->close();

                    ?>

    
                </tbody>
            </table>
    </div>
</div>            
<?php include_once 'footer.php'; ?>
