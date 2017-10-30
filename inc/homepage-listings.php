<?php 

$sql = "SELECT property_id, image_url, title, city, price FROM properties";

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
    $output .= "<a href='process/add-wishlist.php?id=" . $row['property_id'] . "'><i class='icon homepage-heart icon-heart-empty shadow'>Add to wishlist</i></a>";
    $output .= "<div class='property-padding'><div class='property-border'><a href='./view-property?id=" . $row['property_id'] . "'>";
    $output .= "<img class='featured-image' src='".$row['image_url']."'>";
    $output .= "</a>";
    $output .= "<a href='./view-property?id=" . $row['property_id'] . "'><h1 class='listing-title'>".$row["title"]."</h1></a>";
    $output .= "<div class='property-details'><h1 class='listing-city'>".$row["city"]."</h1>";
    $output .= "<h1 class='listing-price'>$".number_format($row["price"])."</h1>";
    $output .= "</div></div></div></div></div>";

    echo $output;
}

} else {
    echo "<p>No properties found.</p>";
}

// close statement
$stmt->close();


