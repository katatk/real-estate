<?php
session_start();
$title = "Home";
include 'header.php';
error_reporting(E_ALL);
ini_set('display_errors', "1");
?>

    <header class="masthead">
        <div class="overlay">
            <div class="container featured-text-container">
                <p class="featured-text1"> AUCKLAND HAMILTON TAURANGA</p>
                <p class="featured-heading">THE REAL ESTATE COMPANY<br>THATS WITH YOU ALL THE WAY</p>
                <p class="featured-text2">HIGH END LUXURY HOUSES &amp; GRAND SECTIONS WITH BEAUTIFUL VIEWS</p>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 search-container">
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
                                    <button type="submit" name="submit" class="btn search-btn"><span class="glyphicon glyphicon-search"></span>SEARCH</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </header>


    <section>
        <div class="container">
            <h1 class="title">Featured Properties</h1>
            <div class="row align-items-center">

                <?php include('homepage-listings.php'); ?>

            </div>
        </div>
    </section>



    <!-- <div class="col-md-6 order-2">
                    <div class="p-5">
                        <img class="featured-image" src="images/auckland1.jpg" alt="auckland1">
                    </div>
                </div>
                <div class="col-md-6 order-1">
                    <div class="p-5">
                        <img class="featured-image" src="images/auckland3.jpg" alt="auckland3">
                    </div>
                </div> -->
    <!-- </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="p-5">
                        <img class="featured-image" src="images/hamilton3.jpg" alt="hamilton3">

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-5">
                        <img class="featured-image" src="images/hamilton4.jpg" alt="hamilton4">
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
                        <img class="featured-image" src="images/tauranga1.jpg" alt="tauranga1">
                    </div>
                </div>
                <div class="col-md-6 order-1">
                    <div class="p-5">
                        <img class="featured-image" src="images/tauranga4.jpg" alt="tauranga4">
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <?php include 'footer.php'; ?>
