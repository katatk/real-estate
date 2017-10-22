<?php
session_start();
$title = "Home";

include_once 'header.php';
            
?>
       <header class="masthead">
        <div class="overlay">
            <div class="container featured-text-container">
                <a href="./search?city=Auckland">AUCKLAND</a> 
                <a href="./search?city=Hamilton">HAMILTON</a>
                <a href="./search?city=Tauranga">TAURANGA</a>
                <p class="featured-heading">THE REAL ESTATE COMPANY<br>THATS WITH YOU ALL THE WAY</p>
                <p class="featured-text2">HIGH END LUXURY HOUSES &amp; GRAND SECTIONS WITH BEAUTIFUL VIEWS</p>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 search-container">
                              
                               <?php include_once 'search-form.php'; ?>
                               
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </header>

    <section>
        <h1 class="title">Results <?php echo (isset($_GET['city']) ? "For " . $_GET['city'] : "")?> </h1>
        <div class="row align-items-center">
            <?php

            if (isset($_GET['submit']) || isset($_GET['city'])) {

                $city = $_GET['city'];

                if ($city == 'All Cities') {
                    $sql = "SELECT * FROM properties";
                    $stmt = $db->prepare($sql);

                } else {
                    $sql = "SELECT * FROM properties WHERE City=?";
                    $stmt = $db->prepare($sql);
                    $stmt->bind_param('s', $city);
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


    <?php include_once 'footer.php'; ?>