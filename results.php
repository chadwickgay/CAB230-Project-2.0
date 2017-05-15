<?php
include("server/PHP/master.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Results</title>
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
</head>

<body>

    <div class="container">

        <!-- Page Navigation
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('server/includes/nav.inc'); ?>

        <!-- Main Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <h3>Search results</h3>
        <div class="container">

            <div class="row">

                <div class="one columns">


                    <div id="results-map"></div>

                    <script>
                        function initMap() {
                            var location = {
                                lat: -27.38006149,
                                lng: 153.0387005
                            };
                            var map = new google.maps.Map(document.getElementById('results-map'), {
                                zoom: 15,
                                center: location
                            });
                            var marker = new google.maps.Marker({
                                position: location,
                                map: map
                            });
                        }

                    </script>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_iTOki0siv_6GfltBuY3oXx5mfeLaRZ4&callback=initMap">
                    </script>
                </div>
                
                <div class="one columns">

                    <?php showAllParks(); ?>

        <!-- Footer
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('server/includes/footer.inc'); ?>


        <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    </div>


</body>

</html>
