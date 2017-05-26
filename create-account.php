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
		    validatePassword($errors, $_POST, 'password');
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
			include("server/PHP/master.php");

			try {
				$stmt = $pdo->prepare('SELECT Email FROM members WHERE Email=:email');
				$stmt->bindValue(':email', $_POST['email']);
				$stmt->execute();
				if ($stmt != false && $stmt->rowCount()) {
					echo 'An account with this email address already exists!<br>';
					echo "Email: \"".$_POST['email']."\"<br>";
				} else {
					$stmt = $pdo->prepare('INSERT INTO members (Email, Salt, Password, FirstName, LastName, DOB, Gender) VALUES (:email, :salt, SHA2(CONCAT(:password, :salt), 0), :firstname, :lastname, :dob, :genderid)');
					$stmt->bindValue(':email', $_POST['email']);
					$stmt->bindValue(':salt', generate_uid());
					$stmt->bindValue(':password', $_POST['password']);
					$stmt->bindValue(':firstname', $_POST['first-name']);
					$stmt->bindValue(':lastname', $_POST['last-name']);
					$tmp_dob = explode('/', $_POST['dob']);
					$tmp_dob = ''.$tmp_dob[2].'-'.$tmp_dob[1].'-'.$tmp_dob[0];
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
			}  catch (PDOException $e) {
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
