<?php 
session_start();
$title = "Dashboard";
include 'dashboard-header.php'; 

if (!$_SESSION['logged_in']) {
  header('Location: login.php');
  die(); 
}
?>

<div class="container">

    <main class="col-xs-12 pt-3" role="main">
        <h1>Dashboard</h1>

        <span class="welcome">Welcome, <?php echo $_SESSION['first_name']; ?></span>

        <h2>Properties</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>City</th>
                        <th>Price</th>
                        <th>Address</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- fetch properties from the database -->
                    <?php

                    include('config.php');

                    $sql = "SELECT * FROM properties ORDER BY Property_ID";

                    $result = $db->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>".$row["Property_ID"]."</td><td>".$row["Title"]."</td><td>".$row["Type"]."</td><td>".$row["City"]."</td><td>".$row["Price"]."</td><td>".$row["Address"]."</td><td>".$row["Description"]."</td></tr>";
                        }
                    } else {
                        echo "0 results";
                    }

                    mysqli_close($db);
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<?php include 'dashboard-footer.php'; ?>
