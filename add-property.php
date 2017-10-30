<?php 

$title = "Add a Property";
include_once 'inc/dashboard-header.php'; 

// user has to be logged in as admin to access this page
if (!$_SESSION['logged_in'] || $_SESSION['role'] == 'User') {
$_SESSION['alertMessage'] = 'You do not have access to this page, you must be logged in as admin.';
  header('Location: login');
  die(); 
}

// adding not editing
$edit = false;

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
        array_push($cityArray, ($row["city"]));

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
        array_push($typeArray, ($row["type"]));
    }
}

 // close statement
$stmt->close();

if (isset($_GET['id'])) {

    $property_id = $_GET['id'];

    $sql = "SELECT property_id, image_url, title, type, city, price, address, description FROM properties WHERE property_id=?";

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
    
    // if no id set, we are adding new property not editing an existing one
    $edit = ($stored_id !== null);
    }
  
    // if id is set in get, we are editing listing
    if ($edit) {
    $_SESSION['property_id'] = $stored_id;
    $_SESSION['img_url'] = $stored_img_url;
    $_SESSION['title'] = $stored_title;
    $_SESSION['type'] = $stored_type;
    $_SESSION['city'] = $stored_city;
    $_SESSION['price'] = $stored_price;
    $_SESSION['address'] = $stored_address;
    $_SESSION['description'] = $stored_description;
}

?>

<div class="row">
    <div class="col-12">

        <h1 class="title">Dashboard</h1>

        <span class="welcome">Welcome, <?php echo $_SESSION['first_name']; ?></span>

        <h2>Add/Edit a Property</h2>

        <?php 
        if (isset($_SESSION['alertMessage'])) { 
            echo "<p>".$_SESSION['alertMessage']."</p>"; 
            unset($_SESSION['alertMessage']);
        }; 
        ?>
        <form method="post" action="process/add-property-processing.php" enctype="multipart/form-data">

            <input type="hidden" value="<?php 
                if (isset($_SESSION['property_id'])) 
                    echo $_SESSION['property_id']; 
                    unset($_SESSION['property_id']);
                ?>" name="id">

            <div class="form-group">

              
                <?php if($edit) {
                    echo "<h6>Current Image</h6><p><img src='" . $_SESSION['img_url'] . "' class='thumbnail' id='uploaded-img'></p>";
                } ?>
                <label for="img-url">Image URL</label>
                <input type="text" class="form-control" id="img-url" name="img-url" placeholder="eg. http://www.houses.com/your-property.jpg" value="<?php 
                if (isset($_SESSION['img_url'])) 
                    echo $_SESSION['img_url']; 
                    unset($_SESSION['img_url']);
                ?>">

                <label for="input-img-upload">or upload an image</label>
                <input type="file" name="img-upload" accept="image/*" id="input-img-upload" accept=".jpg, .jpeg, .png">
                <br>
                <button type="button" class="btn btn-default" id="btn-remove-file" onclick="removeFile();">
                X Remove uploaded image</button>

                <div class="error">
                    <?php 
                    if (isset($_SESSION['error_img'])) { 
                        echo $_SESSION['error_img'];
                        unset($_SESSION['error_img']);
                    }; 
                    ?>
                </div>
            </div>
            <?php
                   if (isset($_SESSION['img_url'])) {
                        echo "<img class='thumbnail' src='" . $_SESSION['img_url'] . "'>"; 
                   }
                ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php 
                if (isset($_SESSION['title'])) 
                    echo $_SESSION['title']; 
                    unset($_SESSION['title']);
                    ?>">
                    <div class="error">
                        <?php 
            if (isset($_SESSION['error_title'])) { 
                echo $_SESSION['error_title']; 
                unset($_SESSION['error_title']);
            }; 
        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select class="form-control" id="type" name="type">
                <?php 
                foreach ($typeArray as $type) {
                    echo "<option ";
                    echo "value='".$type."'";
                    if(isset($stored_type) && $type == $stored_type) {
                        echo " selected";
                   } elseif(isset($_SESSION['type']) && $type == $_SESSION['type']) {
                        echo " selected";
                    }
                    echo ">";
                    echo $type;
                    echo "</option>";
                }
                ?>
        </select>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <select class="form-control" id="city" name="city">
                 <?php
                 foreach ($cityArray as $city) {
                    echo "<option ";
                    echo "value='".$city."'";
                    if(isset($stored_city) && $city == $stored_city) {
                        echo " selected";
                    } elseif(isset($_SESSION['city']) && $city == $_SESSION['city']) {
                        echo " selected";
                    }
                    echo ">";
                    echo $city;
                    echo "</option>";
                 }
                 ?>
        </select>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="<?php 
                if (isset($_SESSION['price'])) 
                    echo $_SESSION['price']; 
                    unset($_SESSION['price']);
                    ?>">
                    <div class="error">
                        <?php 
            if (isset($_SESSION['error_price'])) { 
                echo $_SESSION['error_price']; 
                unset($_SESSION['error_price']);
            }; 
        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?php 
                if (isset($_SESSION['address'])) 
                    echo $_SESSION['address']; 
                    unset($_SESSION['address']);
                    ?>">
                    <div class="error">
                        <?php 
            if (isset($_SESSION['error_address'])) { 
                echo $_SESSION['error_address']; 
                unset($_SESSION['error_address']);
            }; 
        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" maxlength="500" placeholder="Enter description. Max length 500 characters"><?php 
                if (isset($_SESSION['description'])) 
                    echo $_SESSION['description']; 
                    unset($_SESSION['description']);
                    ?></textarea>
                    <div class="error">
                        <?php 
            if (isset($_SESSION['error_description'])) { 
                echo $_SESSION['error_description']; 
                unset($_SESSION['error_description']);
            }; 
        ?>
                    </div>
                </div>

                <input type="submit" class="btn button" value="submit" name="submit">
        </form>
    </div>
</div>

<script type="text/javascript">
    // button that removes the uploaded file
    function removeFile() {
        document.getElementById('input-img-upload').value = "";
    }
</script>

<?php include_once "inc/footer.php"; ?>
