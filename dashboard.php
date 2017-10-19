<?php 
session_start();
$title = "Dashboard";
include 'dashboard-header.php'; 

if ($_SESSION['logged_in'] == false) {
  header('Location: login.php');
  die(); 
}
?>
<div class="row">
    <div class="col-12">
        <h1>Dashboard</h1>

        <span class="welcome">Welcome, <?php echo $_SESSION['first_name']; ?></span>

        <h2>All Properties</h2>

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
            include('config.php');

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
                    $output .= "<td>".$row["Price"]."</td>";
                    $output .= "<td>".$row["Address"]."</td>";
                    $output .= "<td>".$row["Description"]."</td>";
                    $output .= "<td><button class='btn btn-default'>Edit</button></td>";
                    $output .= "<td><button class='btn btn-danger'>Delete</button></td>";
                    $output .= "</tr>";
                    echo $output;
                }
            } else {
                echo "There are no properties in the database";
            }

            // close statement
            $stmt->close();

            // close the connection
            $db->close();
            ?>

            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
