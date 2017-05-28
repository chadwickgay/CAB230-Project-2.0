<?php
include("server/PHP/database.php");
include("server/PHP/formFunctions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <?php include('server/includes/head.inc'); ?>
    <title>Park Search - Login</title>

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

            // validate format of email and password
            validateEmail($errors, $_POST, 'email');
            validateLoginPassword($errors, $_POST, 'password');

            $password = $_POST['password'];
            // sanitize input before login
            $email = sanitizeInput($_POST['email']);

            if (sizeof($errors) <= 0) {
                if (login($email, $password)) {

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
