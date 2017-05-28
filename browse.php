<?php
include("server/PHP/database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <?php include('server/includes/head.inc'); ?>
    <title>Park Search - Browse</title>

    <!-- JS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script type="text/javascript" src="scripts/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_iTOki0siv_6GfltBuY3oXx5mfeLaRZ4&"></script>
</head>

<body>

<div class="container">

    <!-- Header & Page Navigation
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <?php include('server/includes/nav.inc'); ?>

    <!-- Main Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <h3>Browse for parks</h3>

    <?php include('server/includes/browseForm.inc'); ?>

    <?php

    if (isset($_GET['park-name']) || isset($_GET['suburb']) || isset($_GET['rating']) || isset($_GET['distance'])) {
        echo '<h3>Search Results</h3>';
        if (isset($_GET['park-name'])) {
            $parkName = sanitizeInput($_GET["park-name"]);
            echo "<p>Search by name containing: \"$parkName\"</p>";
            $results = searchParkByName($parkName);

        } else if (isset($_GET['suburb'])) {

            $suburb = sanitizeInput($_GET["suburb"]);
            echo "<p>Search by suburb: \"$suburb\"</p>";
            $results = searchParkBySuburb($suburb);

        } else if (isset($_GET['rating'])) {
            $rating = sanitizeInput($_GET["rating"]);
            echo "<p>Search by minimum rating: \"$rating\"</p>";
            $results = searchParkByRating($rating);

        } else if (isset($_GET['distance'])) {
            $userDistance = sanitizeInput($_GET["distance"]);
            $userLatitude = $_GET['lat'];
            $userLongitude = $_GET['long'];
            $results = searchParksByDistance($userLatitude, $userLongitude, $userDistance);
            echo "<p>Search by parks within \"$userDistance\" Km</p>";
        }

        // Display results page map with park markers
        displayMapResults($results);

        // Call outputSearchResults to output results table
        outputSearchResults($results);
    }

    ?>


    <!-- Footer
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <?php include('server/includes/footer.inc'); ?>

    <!-- End Document
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
</div>

</body>

</html>
