<?php
include("server/PHP/database.php");
include("server/PHP/formFunctions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Create Account</title>
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

    <h3>Create an account</h3>

    <?php
    function redisplayForm(&$errors) {

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
    }

    require 'server/includes/validate.inc';

    $errors = array();
    if (isset($_POST['email'])) {
        validateEmail($errors, $_POST, 'email');
        validateFirstName($errors, $_POST, 'first-name');
        validateLastName($errors, $_POST, 'last-name');
        validateGender($errors, $_POST, 'gender');
        validateDOB($errors, $_POST, 'dob');
        validatePassword($errors, $_POST, 'password');
        if ($errors) {
            redisplayForm($errors);
        } else {

            try {
                $stmt = $pdo->prepare('SELECT Email FROM members WHERE Email=:email');
                $stmt->bindValue(':email', $_POST['email']);
                $stmt->execute();
                if ($stmt != false && $stmt->rowCount()) {
                    $errors['email'] = "An account with this email address already exists!<br>Email: \"" . $_POST['email'] . "\"";
                    $errors['password'] = "Please re-enter your password.";
                    redisplayForm($errors);
                } else {
                    $stmt = $pdo->prepare('INSERT INTO members (Email, Salt, Password, FirstName, LastName, DOB, Gender) VALUES (:email, :salt, SHA2(CONCAT(:password, :salt), 0), :firstname, :lastname, :dob, :genderid)');
                    $stmt->bindValue(':email', $_POST['email']);
                    $stmt->bindValue(':salt', generate_rand_string());
                    $stmt->bindValue(':password', $_POST['password']);
                    $stmt->bindValue(':firstname', $_POST['first-name']);
                    $stmt->bindValue(':lastname', $_POST['last-name']);
                    $tmp_dob = explode('/', $_POST['dob']);
                    $tmp_dob = '' . $tmp_dob[2] . '-' . $tmp_dob[1] . '-' . $tmp_dob[0];
                    $stmt->bindValue(':dob', $tmp_dob);
                    $stmt->bindValue(':genderid', $_POST['gender']);
                    $stmt->execute();

                    if (login($_POST['email'], $_POST['password'])) {
                        echo 'You have successfully logged in!';
                        echo "<script>redirectToPage('/');</script>";
                    } else {
                        echo 'Internal Error #789h';
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                echo 'Internal Error #b67d';
            }
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
