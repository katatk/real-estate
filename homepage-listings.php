<?php 

$sql = "SELECT Property_ID, Image_URL, Title, City, Price FROM properties";

$stmt = $db->prepare($sql);
                   
    if ($stmt === false) {
    printf("Errormessage: %s\n", $db->error);
    die();
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
    $output .= "<div class='col-lg-6 col-12'><div class='p-5'>";
    $output .= "<form method='post' action='add-wishlist.php' enctype='multipart/form-data'><a href='add-wishlist?id=" . $row['Property_ID'] . "'><i class='icon homepage-heart icon-heart-empty shadow'></i></a></form>";
    $output .= "<div class='property-padding'><div class='property-border'><a href='./view-property?id=" . $row['Property_ID'] . "'>";
    $output .= "<img class='featured-image' src='".$row['Image_URL']."'>";
    $output .= "</a>";
    $output .= "<h1 class='listing-title'>".$row["Title"]."</h1>";
    $output .= "<div class='property-details'><h1 class='listing-city'>".$row["City"]."</h1>";
    $output .= "<h1 class='listing-price'>$".number_format($row["Price"])."</h1>";
    $output .= "</div></div></div></div></div>";

    echo $output;
}

} else {
    echo "<p>No properties found.</p>";
}

// close statement
$stmt->close();


