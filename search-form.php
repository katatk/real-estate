<?php

// get all the cities and property types
$cityArray = [];
$typeArray = [];

$sql = "SELECT * FROM cities";

$stmt = $db->prepare($sql);

if ($stmt === false) {
    echo "SQL statement error message: " . $db->error;
    die();
}

$stmt->execute();

$results = $stmt->get_result();

if ($results->num_rows > 0) {
    // output data of each row
    while($row = $results->fetch_assoc()) {
        array_push($cityArray, ($row["City"]));
    }
}

// close statement
$stmt->close();

$sql = "SELECT * FROM property_type";

$stmt = $db->prepare($sql);

if ($stmt === false) {
    echo "SQL statement error message:  " . $db->error;
    die();
}

$stmt->execute();

$results = $stmt->get_result();

if ($results->num_rows > 0) {
    // output data of each row
    while($row = $results->fetch_assoc()) {
        array_push($typeArray, ($row["Type"]));
    }
}

// close statement
$stmt->close();

?>

 <form method="get" action="search.php">
    <div class="form-group search-separator">
        <label for="city">CITY</label>
        <select name="city" id="city">
            <option value="All Cities">All Cities</option>
            <?php 
            foreach ($cityArray as $city) {
            echo "<option value='".$city."'>".$city."</option>";
            }
            ?>
        </select>
    </div>
     <div class="form-group search-separator">
        <label for="property-type">PROPERTY TYPE</label>
        <select name="property-type" id="property-type">
           <option value="All Types">All Types</option>
            <?php 
            foreach ($typeArray as $type) {
            echo "<option value='".$type."'>".$type."</option>";
            }
            ?>
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
            <option value="0">$0</option>
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