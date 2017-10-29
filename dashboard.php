<?php 

$title = "Dashboard";
include_once 'inc/dashboard-header.php'; 

// user has to be logged in as admin to access this page
if (!$_SESSION['logged_in'] || $_SESSION['role'] == 'User') {
$_SESSION['alertMessage'] = 'You do not have access to this page, you must be logged in as admin.';
  header('Location: login');
  die(); 
}

?>
<div class="row">
    <div class="col-12">
        <h1 class="title">Dashboard</h1>

        <span class="welcome">Welcome, <?php echo $_SESSION['first_name']; ?></span>

        <h2>All Properties</h2>
        <?php 
        if (isset($_SESSION['alertMessage'])) { 
            echo "<p>".$_SESSION['alertMessage']."</p>"; 
            unset($_SESSION['alertMessage']);
        }; 
        ?>
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>City</th>
                    <th>Price</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Edit Property</th>
                    <th>Delete Property</th>
                </tr>
            </thead>
            <tbody>
            <!-- fetch properties from the database -->
            <?php

            $sql = "SELECT * FROM properties ORDER BY property_id";
            
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
                    $output = "<tr>";
                    $output .= "<td>".$row["property_id"]."</td>";
                    $output .= "<td><img src='".$row["image_url"]."' alt='".$row["title"]."' class='thumbnail'></td>";
                    $output .= "<td>".$row["title"]."</td>";
                    $output .= "<td>".$row["type"]."</td>";
                    $output .= "<td>".$row["city"]."</td>";
                    $output .= "<td>$" . number_format($row["price"])."</td>";
                    $output .= "<td>".$row["address"]."</td>";
                    $output .= "<td>".$row["description"]."</td>";
                    $output .= "<td><a class='btn btn-default' href='add-property.php?id=".$row["property_id"]."'>Edit</a></td>";
                    $output .= "<td><a href='process/delete-property.php?id=".$row["property_id"]."' class='btn btn-danger'>Delete</a></td>";
                    $output .= "</tr>";
                    echo $output;
                }
            } else {
                echo "There are no properties in the database";
            }

            // close statement
            $stmt->close();

            ?>

            </tbody>
        </table>
    </div>
</div>

<?php include_once 'inc/footer.php'; ?>
