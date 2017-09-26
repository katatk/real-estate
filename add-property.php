<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Real Estate - Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Product+Sans:400,400i,700,700i' rel='stylesheet' type='text/css'>

</head>

<body class="dashboard">

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top dashboard-nav">
        <div class="container">

            <a class="navbar-brand" href="index.html"><img class="logo" src="images/logo.svg" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Overview<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add-property">Add Property     
                      </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout     
                      </a>
                    </li>
                </ul>


            </div>
        </div>

    </nav>

    <div class="container">

        <div class="col-xs-12 pt-3" role="main">
            <h1>Dashboard</h1>
            <span class="welcome">Welcome, $First_Name</span>

            <h2>Add a Property</h2>
            <form>
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

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


<?php include "footer.php"; ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')

    </script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
     IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>-->
