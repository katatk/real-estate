<?php 
session_start();
$title = "Dashboard";
include_once 'dashboard-header.php'; 

if ($_SESSION['logged_in'] == false) {
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

            $sql = "SELECT * FROM properties ORDER BY Property_ID";
            
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
                    $output .= "<td>".$row["Property_ID"]."</td>";
                    $output .= "<td><img src='".$row["Image_URL"]."' alt='".$row["Title"]."' class='thumbnail'></td>";
                    $output .= "<td>".$row["Title"]."</td>";
                    $output .= "<td>".$row["Type"]."</td>";
                    $output .= "<td>".$row["City"]."</td>";
                    $output .= "<td>$" . number_format($row["Price"])."</td>";
                    $output .= "<td>".$row["Address"]."</td>";
                    $output .= "<td>".$row["Description"]."</td>";
                    $output .= "<td><a class='btn btn-default' href='add-property.php?id=".$row["Property_ID"]."'>Edit</a></td>";
                    $output .= "<td><form method='get' action='delete-property.php' enctype='multipart/form-data'><a href='delete-property.php?id=".$row["Property_ID"]."' class='btn btn-danger'>Delete</a></form></td>";
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

<?php include_once 'footer.php'; ?>
