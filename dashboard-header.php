<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The dashboard is where you can manage properties as an agent">
    <meta name="author" content="Tayla and Kat">

    <title>Richlist Real Estate Dashboard -
        <?php echo $title ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,400i,700,700i' rel='stylesheet' type='text/css'>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="./"><img class="logo" src="images/logo.svg" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['logged_in']) && ($_SESSION['role'] == "Agent" || $_SESSION['role'] == "Admin")) {
                                echo "<li class='nav-item";
                                echo ($title == 'Dashboard') ? ' active' : '';
                                echo "'><a class='nav-link' href='dashboard'>Dashboard</a></li>";
                                }
                        ?>
                    <li class="nav-item <?php echo ($title == 'Add Property') ? ' active' : ''; ?>">
                        <a class="nav-link" href="add-property">Add Property</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./">View Site</a>
                    </li>
                    <?php if (isset($_SESSION['logged_in'])) {
                                    echo "<li class='nav-item'><a class='nav-link' href='logout'>Logout</a></li>";
                                }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container flex" role="main">
