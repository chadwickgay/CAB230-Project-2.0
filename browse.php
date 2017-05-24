<?php
include("server/PHP/master.php");
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_iTOki0siv_6GfltBuY3oXx5mfeLaRZ4&callback=initMap"></script> 
</head>

<body>

    <div class="container">

        <!-- Page Navigation
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('server/includes/nav.inc'); ?>

        <!-- Main Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <h3>Browse for parks</h3>

        <?php include('server/includes/browseForm.inc'); ?>

        <?php

        if (isset($_GET['park-name']) || isset($_GET['suburb']) || isset($_GET['rating'])){

			echo '<div id="results-map"></div>', 
				'<script type="text/javascript">', 
				'initResultsMap(dummyLocations);', 
				'</script>'; 
			
            $parkName = isset($_GET["park-name"]) ? $_GET["park-name"] : '';
            $suburb = isset($_GET["suburb"]) ? $_GET["suburb"] : '';
            $rating = isset($_GET["rating"]) ? $_GET["rating"] : '';

            // Execute searchForParks to search for all user inputs & output results to page
            searchForParks($parkName, $suburb);

        }

        if (isset($_GET['distance'])){
            $userDistance = isset($_GET["distance"]) ? $_GET["distance"] : '';
            $userLatitude=(isset($_GET['lat']))?$_GET['lat']:'';
            $userLongitude=(isset($_GET['long']))?$_GET['long']:'';

            echo $userDistance;
            $userLatitude = '-27.4366260';
            $userLongitude = '153.0588840';

            getParksWithinRange($userLatitude, $userLongitude, $userDistance);
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
