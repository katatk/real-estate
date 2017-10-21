<?php

function getAllCitiesAndTypes($db) {
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
}

function getPropertyById($db, $param_id) {
    if ($param_id) {
   
    $property_id = $param_id;
    
    $sql = "SELECT Property_ID, Image_URL, Title, Type, City, Price, Address, Description FROM properties WHERE Property_ID=?";
    
    $stmt = $db->prepare($sql);
    
    if ($stmt === false) {
        echo "SQL statement error message: " . $db->error;
        die();
    }
    
    $stmt->bind_param('i', $property_id);

    // running insert statement
      if ($stmt->execute() === false) {
        echo "Error: " . $db->error;
        die();
    }
    
     $stmt->bind_result($stored_id, $stored_img_url, $stored_title, $stored_type, $stored_city, $stored_price, $stored_address, $stored_description);
    
    // fetch value
    $stmt->fetch();

    // close statement
    $stmt->close();
    
    // close connection
    $db->close();  
    
}

    
}

function sqlInsert($db, $param_table, $param_columns, $param_values) {
    
}

function sqlSelect($db, $param_column, $param_table, $param_where=null) {
    
}