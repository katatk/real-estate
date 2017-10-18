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
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
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
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="3" maxlength="500" placeholder="Enter description. Max length 500 characters"></textarea>
    </div>

    <input type="submit" class="btn btn-primary button" value="submit">
</form>


<?php include "dashboard-footer.php"; ?>