<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rich List - Search Results</title>

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
        <a class="navbar-brand" href="index.html"><img class="logo" src="images/logo.svg" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.html">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.html">ABOUT US</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="contact.html">CONTACT</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="">
      <div class="overlay">
        <div class="container featured-text-container">
          <h1 class="title">Search Results</h1>
        </div>
      </div>
    </header>

<div class="row">
<div class="col-lg-12 search-container">
<h3>SEARCH</h3>
<form method="post" action="search-function.php">
<div class="form-group search-separator">
    <label for="city">CITY</label>
    <select name="city" id="city">
        <option value="auckland">All Cities</option>
        <option value="auckland">Auckland</option>
        <option value="hamilton">Hamilton</option>
        <option value="tauranga">Tauranga</option>
    </select>
</div>
<div class="form-group search-separator">
    <label for="property-type">PROPERTY TYPE</label>
    <select name="property-type" id="property-type">
        <option value="auckland">All Types</option>
        <option value="auckland">House</option>
        <option value="hamilton">Section</option>
    </select>
</div>
<div class="form-group search-separator">
    <label for="price">PRICE</label>
    <select name="price-min" id="price-min">
        <option value="0">$0</option>
        <option value="100">$100k</option>
        <option value="500">$500k</option>
        <option value="1m">$1M</option>
        <option value="2m">$2M</option>
        <option value="5m">$5M</option>
        <option value="10m">$10M+</option>
    </select> to
    <select name="price-max" id="price-max">
        <option value="0">$0</option>
        <option value="100">$100k</option>
        <option value="500">$500k</option>
        <option value="1m">$1M</option>
        <option value="2m">$2M</option>
        <option value="5m">$5M</option>
        <option value="10m" selected>$10M+</option>
    </select>
</div>
<button type="submit" name="submit" class="btn search-btn"><span class="glyphicon glyphicon-search"></span>Search</button>
</form>
</div>
</div>

<section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2">
                    <div class="p-5">
                        <h2>Image here</h2>
                        <p>Text here Text hereText hereText hereText hereText hereText hereText hereText hereText here</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-5">
                        <h2>Image here</h2>
                        <p>Text here Text hereText hereText hereText hereText hereText hereText hereText hereText here</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="p-5">
                        <h2>Image here</h2>
                        <p>Text here Text hereText hereText hereText hereText hereText hereText hereText hereText here</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-5">
                        <h2>Image here</h2>
                        <p>Text here Text hereText hereText hereText hereText hereText hereText hereText hereText here</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2">
                    <div class="p-5">
                        <h2>Image here</h2>
                        <p>Text here Text hereText hereText hereText hereText hereText hereText hereText hereText here</p>
                    </div>
                </div>
                <div class="col-md-6 order-1">
                    <div class="p-5">
                        <h2>Image here</h2>
                        <p>Text here Text hereText hereText hereText hereText hereText hereText hereText hereText here</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    <footer class="py-5">
      <div class="container">
        <p class="m-0 text-center">Copyright &copy; Rich List 2017</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  </body>

</html>