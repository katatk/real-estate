<?php
session_start();

$title = "View Property";
 
(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true && ($_SESSION['role'] == "Agent" || $_SESSION['role'] == "Admin")) ? include_once 'dashboard-header.php' : include_once 'header.php';
?>

    <div class="row">
        <div class="col-12">

        <?php

        if(!isset($_GET['id'])) {
            echo "<p>Property not found.</p>";
        } else {
            
            $id = $_GET['id'];
            
            $sql = "SELECT Image_URL, Title, Type, City, Price, Address, Description FROM properties WHERE Property_ID=?";

            $stmt = $db->prepare($sql);

            if ($stmt === false) {
                echo "SQL statement error message: " . $db->error;
                die();
            }

            $stmt->bind_param('i', $id);

            // running insert statement
              if ($stmt->execute() === false) {
                echo "Error: " . $db->error;
                die();
            }

             $stmt->bind_result($stored_img_url, $stored_title, $stored_type, $stored_city, $stored_price, $stored_address, $stored_description);

            // fetch value
            $stmt->fetch();

            // close statement
            $stmt->close();

            $output = "</div><div class='col-12 col-lg-8'>";
            $output .= "<img class='own-listing-image'src='" . $stored_img_url . "' alt='" .$stored_title. "'></div>";
            $output .= "<div class='col-12 col-lg-4'><form method='post' action='add-wishlist.php' enctype='multipart/form-data'><a href='add-wishlist?id=".$id."'><i class='icon own-heart icon-heart-empty shadow'></i></a></form><h1 class='own-listing-title'>" . $stored_title . "</h1>";
            // $output .= "<h2>" . $stored_type . "</h2>";
            $output .= "<h2 class='own-listing-details'>" . $stored_city . "</h2>";
            $output .= "<h2 class='own-listing-price'>$" . number_format($stored_price) . "</h2>";
            // $output .= "<p>Address: " . $stored_address . "</p>";
            $output .= "<p class='own-listing-details'>" . $stored_description . "</p></span></div>";
            
            echo $output;
            }

        ?>

        
    </div>

    <?php include_once 'footer.php' ?>
