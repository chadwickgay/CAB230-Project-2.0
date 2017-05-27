<?php
include("server/PHP/database.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Login</title>
    <meta name="description" content="Website to search for parks located in Brisbane">
    <meta name="keywords" content="Parks, Brisbane Parks, Recreation">
    <meta name="author" content="Chadwick Gay, Tom Deakin & Kenneth Koefler">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="images/favicon.png?version=1">

    <!-- JS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script type="text/javascript" src="scripts/validation.js"></script>
</head>

<body>

<div class="container">

    <!-- Header & Page Navigation
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <?php include('server/includes/nav.inc'); ?>

    <!-- Main Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <h3>Sign into existing account</h3>

    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['logged'])) {
        $errors = array();
        if (isset($_POST['email']) && isset($_POST['password'])) {
            require 'server/includes/validate.inc';
            validateEmail($errors, $_POST, 'email');
            validatePassword($errors, $_POST, 'password');
            if (sizeof($errors) <= 0) {
                if (login($_POST['email'], $_POST['password'])) {

                } else {
                    $errors["invalid_login"] = "The Username and/or Password provided is incorrect.";
                }
            }
            if ($errors) {

                echo '<div class="validation">';
                echo '<h5>Invalid submission, correct the following errors:</h5>';
                echo '<ul>';
                foreach ($errors as $field => $error) {
                    echo "<li>$error</li>";
                }
                echo '</ul>';
                echo '</div>';
                // redisplay the form
                include 'server/includes/loginForm.inc';
            } else {
                echo 'You have successfully logged in!';
                echo "<script>redirectToPage('/');</script>";
            }
        } else {
            include 'server/includes/loginForm.inc';
        }
    } else {
        echo 'You are already logged in!';
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
