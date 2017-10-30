<?php
$title = "Search";

include_once 'inc/header.php';

?>
    <header class="masthead">
        <div class="overlay">
            <div class="container featured-text-container">
                <p class="featured-text1">
                    <a href="./search?city=Auckland">AUCKLAND</a>
                    <a href="./search?city=Hamilton">HAMILTON</a>
                    <a href="./search?city=Tauranga">TAURANGA</a>
                </p>
                <p class="featured-heading">THE REAL ESTATE COMPANY<br>THAT'S WITH YOU ALL THE WAY</p>
                <p class="featured-text2">HIGH END LUXURY HOUSES &amp; GRAND SECTIONS WITH BEAUTIFUL VIEWS</p>
                <section>

                    <div class="row">
                        <div class="col-12 search-container">

                            <?php include_once 'inc/search-form.php'; ?>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </header>
    <!-- container-fluid -->
    </div>
    <div class="container">
        <section>


            <?php

if(isset($_GET['city'])) {
   
    $city = $_GET['city'];
    
    // if get get request is made by selecting a city, not submitting form
    if (!isset($_GET['submit'])) {
        $sql = "SELECT * FROM properties WHERE city=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('s', $city);

        // if get request is made through search form, get all the values of search fields
    } else {
 
        $type = $_GET['type'];
        $price_min = $_GET['price-min'];
        $price_max = $_GET['price-max'];
        
        $sql_select_all = "SELECT * FROM properties WHERE ";
        $sql_price_range = "PRICE BETWEEN ? AND ?";
        
        // if all cities and all types selected
        if ($city == 'All Cities' && $type == 'All Types') {
            
            $sql = $sql_select_all . $sql_price_range;
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ss', $price_min, $price_max);
            
        // if values are set
        } elseif ($city != 'All Cities' && $type != 'All Types') {
            
            $sql = $sql_select_all . "city=? AND =? AND " . $sql_price_range;
            $stmt = $db->prepare($sql);
            $stmt->bind_param('ssss', $city, $type, $price_min, $price_max);
            
            // all cities selected, one type selected
        } elseif ($city == 'All Cities' && $type != 'All Types') {
            
            $sql = $sql_select_all . "=? AND " . $sql_price_range;
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sss', $type, $price_min, $price_max);
            
             // all types selected, one city selected
        } elseif ($city != 'All Cities' && $type == 'All Types') {
             $sql = $sql_select_all . "city=? AND " . $sql_price_range;
            
            $stmt = $db->prepare($sql);
            $stmt->bind_param('sss', $city, $price_min, $price_max);
        }
        
    }
        // running insert statement
        if ($stmt->execute() === false) {
            echo "Error: " . $db->error;
        }

        $results = $stmt->get_result();
        
        $output = "";
        if ($results->num_rows > 0) {
            // output data of each row
            while($row = $results->fetch_assoc()) {
               
                $output .= "<div class='col-md-6'><div class='p-5'>";
                $output .= "<a href='process/add-wishlist?id=" . $row['property_id'] . "'><i class='icon homepage-heart icon-heart-empty shadow'>Add to wishlist</i></a>";
                $output .= "<div class='property-padding'><div class='property-border'><a href='./view-property?id=" . $row['property_id'] . "'>";
                $output .= "<img class='featured-image' src='".$row['image_url']."'>";
                $output .= "</a>";
                $output .= "<a href='./view-property?id=" . $row['property_id'] . "'><h1 class='listing-title'>".$row["title"]."</h1></a>";
                $output .= "<div class='property-details'><h1 class='listing-city'>".$row["city"]."</h1>";
                $output .= "<h1 class='listing-price'>$".number_format($row["price"])."</h1>";
                $output .= "</div></div></div></div></div>";

                  $_SESSION['num_results'] = $results->num_rows;
            }
          
       

        } else {
            $output = "<p>No properties found.</p>";
        }

        // close statement
        $stmt->close();

}
?>
                <h1 class="title">
                    <?php echo (isset($_SESSION['num_results']) ? $_SESSION['num_results'] : "")?> Results
                    <?php echo (isset($_GET['city']) ? "For " . $_GET['city'] : "")?> </h1>
                <div class="row align-items-center">
                <?php echo $output; ?>
                </div>
        </section>
    </div>

    <?php include_once 'inc/footer.php'; ?>
