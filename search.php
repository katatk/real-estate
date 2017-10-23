<?php
session_start();
$title = "Home";

include_once 'header.php';
            
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

                            <?php include_once 'search-form.php'; ?>

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
            <h1 class="title"><?php echo (isset($_SESSION['num_results']) ? $_SESSION['num_results'] : "")?> Results
                <?php echo (isset($_GET['city']) ? "For " . $_GET['city'] : "")?> </h1>
            <div class="row align-items-center">
            <?php
    
            if(isset($_GET['city'])) {
               
                $city = $_GET['city'];
                
                // if get get request is made by selecting a city, not submitting form
                if (!isset($_GET['submit'])) {
                    $sql = "SELECT * FROM properties WHERE City=?";
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
                        
                        $sql = $sql_select_all . "City=? AND Type=? AND " . $sql_price_range;
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('ssss', $city, $type, $price_min, $price_max);
                        
                        // all cities selected, one type selected
                    } elseif ($city == 'All Cities' && $type != 'All Types') {
                        
                        $sql = $sql_select_all . "Type=? AND " . $sql_price_range;
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('sss', $type, $price_min, $price_max);
                        
                         // all types selected, one city selected
                    } elseif ($city != 'All Cities' && $type == 'All Types') {
                         $sql = $sql_select_all . "City=? AND " . $sql_price_range;
                        
                        $stmt = $db->prepare($sql);
                        $stmt->bind_param('sss', $city, $price_min, $price_max);
                    }
                    
                }
                    // running insert statement
                    if ($stmt->execute() === false) {
                        echo "Error: " . $db->error;
                    }

                    $results = $stmt->get_result();
                  

                    if ($results->num_rows > 0) {
                    // output data of each row
                        
                        while($row = $results->fetch_assoc()) {
                            $output = "";
                            $output .= "<div class='col-md-6'><div class='p-5'>";
                            $output .= "<form method='post' action='add-wishlist.php' enctype='multipart/form-data'><a href='add-wishlist?id=" . $row['Property_ID'] . "'><i class='icon icon-heart-empty shadow'></i></a></form>";
                            $output .= "<a href='./view-property?id=" . $row['Property_ID'] . "'>";
                            $output .= "<img class='featured-image' src='".$row['Image_URL']."'>";
                            $output .= "</a>";
                            $output .= "<h1 class='listing-title'>".$row["Title"]."</h1>";
                            $output .= "<h1 class='listing-city'>".$row["City"]."</h1>";
                            $output .= "<h1 class='listing-price'>$".number_format($row["Price"])."</h1>";
                            $output .= "</div></div>";

                            echo $output;
                            
                            $_SESSION['num_results'] = $row;
                        }

                    } else {
                        echo "<p>No properties found.</p>";
                    }

                    // close statement
                    $stmt->close();

            }
            ?>

            </div>
        </section>
    </div>

    <?php include_once 'footer.php'; ?>
