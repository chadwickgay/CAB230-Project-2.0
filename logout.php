<?php
session_start();
unset($_SESSION['logged']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Basic Page Needs -->
	<?php include('server/includes/head.inc'); ?>
	<title>Park Search - Logout</title>
</head>

<body>
	<div class="container">
		<!-- Header & Page Navigation -->
		<?php include('server/includes/nav.inc'); ?>
		
		<!-- Main Content -->
		<h3>You have signed out</h3>

		<!-- Footer -->
		<?php include('server/includes/footer.inc'); ?>
		
		<!-- End Document -->
	</div>
</body>

</html>
