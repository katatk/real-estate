<?php
session_start();

$title = "Home";

include_once 'header.php';

error_reporting(E_ALL);
ini_set('display_errors', "1");

?>
    >
    <header class="masthead">
        <div class="overlay">
            <div class="container featured-text-container">
                <p class="featured-text1">
                    <a href="./search.php?city=Auckland">AUCKLAND</a>
                    <a href="./search.php?city=Hamilton">HAMILTON</a>
                    <a href="./search.php?city=Tauranga">TAURANGA</a>
                </p>
                <p class="featured-heading">THE REAL ESTATE COMPANY<br>THATS WITH YOU ALL THE WAY</p>
                <p class="featured-text2">HIGH END LUXURY HOUSES &amp; GRAND SECTIONS WITH BEAUTIFUL VIEWS</p>
                <section>

                    <div class="row">
                        <div class="col-12 search-container">

                            <?php include_once 'search-form.php'; ?>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </header>
    <!-- container-fluid -->
    </div>
    <div class="container">

        <section>
            <h1 class="title">All Properties</h1>
            <div class="row align-items-center">

                <?php include_once 'homepage-listings.php'; ?>

            </div>
        </section>
    </div>

    <?php include_once 'footer.php'; ?>
