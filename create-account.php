<?php
include("server/PHP/database.php");
include("server/PHP/formFunctions.php");
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
    <!-- Basic Page Needs -->
    <?php include('server/includes/head.inc'); ?>
    <title>Park Search - Create Account</title>

    <!-- JS -->
    <script type="text/javascript" src="scripts/validation.js"></script>
</head>
	
<body>
	<div class="container">

		<!-- Header & Page Navigation -->
		<?php include('server/includes/nav.inc'); ?>
		
		<!-- Main Content -->
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
			validateCreatePassword($errors, $_POST, 'password', 'confirm-password');
			validatePostcode($errors, $_POST, 'postcode', 'postcodeConfirm');
			
			if ($errors) {
				redisplayForm($errors);
			} else {
				$email = sanitizeInput($_POST['email']);
				$firstName = sanitizeInput($_POST['first-name']);
				$lastName = sanitizeInput($_POST['last-name']);
				$dob = sanitizeInput($_POST['dob']);
				$gender = $_POST['gender'];
				
				createAccount($email, $firstName, $lastName, $dob, $gender);
			}
		} else {
			include 'server/includes/accountForm.inc';
		}
		?>
		
		<!-- Footer -->
		<?php include('server/includes/footer.inc'); ?>
		
		<!-- End Document -->
	</div>
</body>
	
</html>

