<?php include('config.php'); 

echo "hi"; 
$sql = "SELECT Image_URL, Title, City, Price FROM properties";

$stmt = $db->prepare($sql);
                   
        if ($stmt === false) {
        printf("Errormessage: %s\n", $db->error);
        die();
        }
       
       
$stmt->execute();

$results = $stmt->get_result();

if ($results->num_rows > 0) {
// output data of each row

while($row = $results->fetch_assoc()) {
    $output = "";
    $output .= "<img src='".$row['Image_URL']."'>";
    $output .= "<h1 class='listing-title'>".$row["Title"]."</h1>";
    $output .= "<h1 class='listing-city'>".$row["City"]."</h1>";
    $output .= "<h1 class='listing-price'>".$row["Price"]."</h1>";

    echo $output;
}

} else {
echo "No properties found.";
}

// close statement
$stmt->close();

// close the connection
$db->close();

