<?php 
session_start();
$title = "Add a Property";
include 'dashboard-header.php'; 

if (!$_SESSION['logged_in']) {
  header('Location: login.php');
  die(); 
}

include 'config.php';
include 'sql-statements.php';

// adding not editing
$edit = false;

// get property by id
getPropertyById($db, $_GET['id']);

// get all cities and property types
getAllCitiesAndTypes($db);

// close connection
$db->close();  

$edit = ($stored_id !== null);

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

        <h1>Dashboard</h1>

        <span class="welcome">Welcome, <?php echo $_SESSION['first_name']; ?></span>

        <h2>Add/Edit a Property</h2>

        <?php 
        if (isset($_SESSION['alertMessage'])) { 
            echo "<p>".$_SESSION['alertMessage']."</p>"; 
            unset($_SESSION['alertMessage']);
        }; 
        ?>
        <form method="post" action="form-add-property.php" enctype="multipart/form-data">
           
           <input type="hidden" value="<?php 
                if (isset($_SESSION['property_id'])) 
                    echo $_SESSION['property_id']; 
                    unset($_SESSION['property_id']);
                ?>" name="id">
           
            <div class="form-group">
                <label for="img-url">Image URL</label>
                <input type="text" class="form-control" id="img-url" name="img-url" placeholder="eg. http://www.houses.com/your-property.jpg" value="<?php 
                if (isset($_SESSION['img_url'])) 
                    echo $_SESSION['img_url']; 
                    unset($_SESSION['img_url']);
                ?>">

                <label for="img-url">or upload an image</label>
                <input type="file" name="img-upload" accept="image/*">
                <div class="error">
                    <?php 
            if (isset($_SESSION['error_img'])) { 
                echo $_SESSION['error_img'];
                unset($_SESSION['error_img']);
            }; 
        ?>
                </div>
            </div>
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
                <?php foreach ($typeArray as $type) {
                  echo "<option ";
                    echo "value='".$type."'";
                    if($type == $stored_type) {
                        echo " selected";
                    }
                    echo ">";
                   echo $type;
                   echo "</option>";
                    }
                ?>
             <!-- <option>Section</option>
              <option>House</option>-->
        </select>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <select class="form-control" id="city" name="city">
                 <?php
                foreach ($cityArray as $city) {
                    echo "<option ";
                    echo "value='".$city."'";
                    if($city == $stored_city) {
                        echo " selected";
                    }
                    echo ">";
                    echo $city;
                    echo "</option>";
                }
                ?>
            <!--<option>Auckland</option>
            <option>Hamilton</option>
            <option>Tauranga</option>-->
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

            <input type="submit" class="btn btn-primary button" value="submit" name="submit">
        </form>
    </div>
</div>


<?php include "footer.php"; ?>
