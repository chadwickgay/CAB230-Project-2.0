<?php
include("server/PHP/master.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Create Account</title>
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
    <script type="text/javascript" src="scripts/validation.js"></script>
</head>

<body>

<div class="container">

    <!-- Page Navigation
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <?php include('server/includes/nav.inc'); ?>

    <!-- Main Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <h3>Create an account</h3>

    <?php
    $errors = array();
    if (isset($_POST['email'])) {
        require 'server/includes/validate.inc';
        validateEmail($errors, $_POST, 'email');
        validateFirstName($errors, $_POST, 'first-name');
        validateLastName($errors, $_POST, 'last-name');
        validateGender($errors, $_POST, 'gender');
        validateDOB($errors, $_POST, 'dob');
        if ($errors) {
            ## want to put a red box around this output to highlight the errors
            echo '<div class="validation">';
            echo '<h5>Invalid submission, correct the following errors:</h5>';
            echo '<ul>';
            foreach ($errors as $field => $error) {
                echo "<li>$error</li>";
            }
            echo '</ul>';
            echo '</div>';
            // redisplay the form
            include 'server/includes/accountForm.inc';
        } else {
            echo 'Form submitted successfully with no errors. Great success!';
        }
    } else {
        include 'server/includes/accountForm.inc';
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
