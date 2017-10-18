<?php include('config.php');

// get the values for the select options from the database
$sql = "SELECT * FROM cities FULL JOIN property_type";

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
        
        $city_options = "";
        $city_options .= "<option value='".$row["City"]."'>".$row["City"]."</option>";
        $property_type_options = "";
        $property_type_options .= "<option value='".$row["Type"]."'>".$row["City"]."</option>";
    }
} else {
    echo "You have no properties saved to your wishlist";
}

// close statement
$stmt->close();

// close the connection
$db->close();

?>

   
   <form method="post" action="search-function.php">
    <div class="form-group search-separator">
        <label for="city">CITY</label>
        <select name="city" id="city">
                    <option value="all-cities">All Cities</option>
                    <option value="auckland">Auckland</option>
                    <option value="hamilton">Hamilton</option>
                    <option value="tauranga">Tauranga</option>
                </select>
    </div>
    <div class="form-group search-separator">
        <label for="property-type">PROPERTY TYPE</label>
        <select name="property-type" id="property-type">
                    <option value="all-properties">All Types</option>
                    <option value="house">House</option>
                    <option value="section">Section</option>
                </select>
    </div>
    <div class="form-group search-separator">
        <label for="price">PRICE</label>
        <select name="price-min" id="price-min">
                    <option value="0">$0</option>
                    <option value="100">$100k</option>
                    <option value="500">$500k</option>
                    <option value="1m">$1M</option>
                    <option value="2m">$2M</option>
                    <option value="5m">$5M</option>
                    <option value="10m">$10M+</option>
                </select> to
        <select name="price-max" id="price-max">
                    <option value="100">$100k</option>
                    <option value="500">$500k</option>
                    <option value="1m">$1M</option>
                    <option value="2m">$2M</option>
                    <option value="5m">$5M</option>
                    <option value="10m" selected>$10M+</option>
               </select>
    </div>
    <button type="submit" name="submit" class="btn search-btn"><span class="glyphicon glyphicon-search"></span>SEARCH</button>
</form>
