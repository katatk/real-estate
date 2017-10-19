<?php 
session_start();
$title = "Add a Property";
include 'dashboard-header.php'; 

if (!$_SESSION['logged_in']) {
  header('Location: login.php');
  die(); 
}
?>

<h1>Dashboard</h1>

<span class="welcome">Welcome, <?php echo $_SESSION['first_name']; ?></span>

<h2>Add a Property</h2>

<?php 
if (isset($_SESSION['alertMessage'])) { 
    echo "<p>".$_SESSION['alertMessage']."</p>"; 
    unset($_SESSION['alertMessage']);
}; 
?>
<form method="post" action="form-add-property.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="img-url">Image URL</label>
        <input type="text" class="form-control" id="img-url" name="img-url" placeholder="eg. http://www.houses.com/your-property.jpg">
        <div class="error">
        <?php 
            if (isset($error_img)) { 
                echo $error_img; 
                unset($error_img);
            }; 
        ?>
        </div>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
        <div class="error">
        <?php 
            if (isset($error_title)) { 
                echo $error_title; 
                unset($error_title);
            }; 
        ?>
        </div>
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select class="form-control" id="type" name="type">
              <option>Section</option>
              <option>House</option>
        </select>
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <select class="form-control" id="city" name="city">
            <option>Auckland</option>
            <option>Hamilton</option>
            <option>Tauranga</option>
        </select>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" class="form-control" id="price" name="price" placeholder="Enter price">
        <div class="error">
        <?php 
            if (isset($error_price)) { 
                echo $error_price; 
                unset($error_price);
            }; 
        ?>
        </div>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
         <?php 
            if (isset($error_address)) { 
                echo $error_address; 
                unset($error_address);
            }; 
        ?>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" maxlength="500" placeholder="Enter description. Max length 500 characters"></textarea>
         <?php 
            if (isset($error_description)) { 
                echo $error_description; 
                unset($error_description);
            }; 
        ?>
    </div>

    <input type="submit" class="btn btn-primary button" value="submit" name="submit">
</form>


<?php include "dashboard-footer.php"; ?>