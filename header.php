<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="We sell highend properties and spacious sections with breathtaking views.">
    <meta name="author" content="Tayla and Kat">
    

    <title>Rich List Real Estate -
        <?php echo $title ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/one-page-wonder.css" rel="stylesheet">
    <link href="icons/css/fontello.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,400i,700,700i' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="favicon.ico">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="./"><img class="logo" src="images/logo.svg" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
         <i class="icon-menu"></i>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo ($title == 'Home') ? ' active' : ''; ?>">
                        <a class="nav-link" href="./">Home</a>
                    </li>
                    <li class="nav-item <?php echo ($title == 'About Us') ? ' active' : ''; ?>">
                        <a class="nav-link" href="about">About Us</a>
                        <li class="nav-item <?php echo ($title == 'Contact') ? ' active' : ''; ?>">
                            <a class="nav-link" href="contact">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['logged_in'])) {
                                // if logged in as a normal user, show wishlist link
                                if ($_SESSION['role'] == "User") {
                                    echo "<li class='nav-item";
                                    echo ($title == 'Wishlist') ? ' active' : '';
                                    echo "'><a class='nav-link' href='wishlist'><i class='icon icon-heart-empty'></i>Wishlist</a></li>";
                                    // if an agent/admin, show this menu
                                } elseif ($_SESSION['role'] == "Agent" || $_SESSION['role'] == "Admin") {
                                    echo "<li class='nav-item'><a class='nav-link' href='dashboard'>Dashboard</a></li>";
                                }
                                // if logged in, show logout link
                                echo "<li class='nav-item'><a class='nav-link' href='logout'>Hi ". $_SESSION['first_name'] .", Logout?</a></li>";
                            }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container<?php echo ($title == 'Home') ? '-fluid' : ' flex';?>" role="main">
