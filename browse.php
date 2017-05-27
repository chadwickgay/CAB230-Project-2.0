<?php
include("server/PHP/database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Browse</title>
    <meta name="description" content="">
    <meta name="author" content="Chadwick Gay">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>

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
        if (isset($_GET['park-name'])) {
            $parkName = $_GET["park-name"];
            $results = searchParkByName($parkName);

        } else if (isset($_GET['suburb'])) {

            $suburb = $_GET["suburb"];
            $results = searchParkBySuburb($suburb);

        } else if (isset($_GET['rating'])) {
            $rating = $_GET["rating"];
            $results = searchParkByRating($rating);

        } else if (isset($_GET['distance'])) {
            $userDistance = $_GET["distance"];
            $userLatitude = $_GET['lat'];
            $userLongitude = $_GET['long'];
            $results = searchParksByDistance($userLatitude, $userLongitude, $userDistance);
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
