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
    <script type="text/javascript" src="scripts/script.js"></script>
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

            $parkName = isset($_GET["park-name"]) ? $_GET["park-name"] : '';
            $suburb = isset($_GET["suburb"]) ? $_GET["suburb"] : '';
            // $rating = isset($_GET["rating"]) ? $_GET["rating"] : '';

            searchQuery($parkName, $suburb);


        ?>


        <!-- Footer
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('server/includes/footer.inc'); ?>

        <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    </div>

</body>

</html>
