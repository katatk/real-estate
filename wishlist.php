<?php 
$title = "Wishlist";
include_once 'inc/header.php';

if (!$_SESSION['logged_in']) {
    header('Location: login');
    die(); 
} 

?>
<div class="row">
    <div class="col-12">
        <h1 class="title">Wishlist</h1>

        <p class="welcome">Hi,
            <?php echo $_SESSION['first_name']; ?>
        </p>

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
   
    $sql = "SELECT properties.property_id, properties.image_url, properties.title, properties.type, properties.city, properties.price, properties.address, properties.description FROM user_wishlist INNER JOIN properties ON user_wishlist.property_id = properties.property_id
    WHERE user_wishlist.email_address=?";
    
    $stmt = $db->prepare($sql);
    
    if ($stmt === false) {
    printf("Errormessage: %s\n", $db->error);
    die();
    }
    
    $stmt->bind_param('s', $_SESSION['email_address']);  
    
    $stmt->execute();
    
    $results = $stmt->get_result();
    
    $output = "";            
    if ($results->num_rows > 0) {
        // output data of each row
        while($row = $results->fetch_assoc()) {
            $output .= "<tr><td><a href='./view-property?id=".$row["property_id"]."'><img src='".$row["image_url"]."' class='thumbnail'></a></td>";
            $output .= "<td><a class='wishlist-link' href='./view-property?id=".$row["property_id"]."'>".$row["title"]."</a></td><td>".$row["type"]."</td>";
            $output .= "<td>".$row["city"]."</td><td>$" . number_format($row["price"])."</td>";
            $output .= "<td>".$row["address"]."</td><td>".$row["description"]."</td>";
            $output .= "<td><a href='process/remove-wishlist.php?id=".$row["property_id"]."' class='btn btn-danger'>Remove</a></td></tr>";
        }
    } else {
        $output = "<p>You have no properties saved to your wishlist</p>";
    }
    
    // close statement
    $stmt->close();

    
    echo $output;
    
    ?>



            </tbody>
        </table>
    </div>
</div>
<?php include_once 'inc/footer.php'; ?>
