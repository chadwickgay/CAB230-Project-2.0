<?php
include("server/PHP/master.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Park</title>
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
	
	<?php
		
		function executeQuery($Query) {
			try {
				$db_name = 'parksearch';
				$db_username = 'parkuser';
				$db_password = 'password';
				$db_host = "localhost";
				$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
				return $pdo->query($Query);
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
			return false;
		}

		function echoStars($numberOfStars) {
			echo '<span class="star">';
			if ($numberOfStars < 0) {
				echo "No Rating";
			} else {
				for ($i = $numberOfStars; $i > 0; $i--) {
					echo "&#9733;";
				}
				for ($i = 5 - $numberOfStars; $i > 0; $i--) {
					echo "&#9734;";
				}
			}
			echo '</span>';
		}
		
		$ParkCode = htmlspecialchars(isset($_GET['ParkCode']) ? $_GET['ParkCode'] : "");
		$Park = array('ID' => -1, 'RatingAvg' => -1);
		$Parks = executeQuery("SELECT ID, ParkCode, Name, Street, Suburb, Easting, Northing, Latitude, Longitude FROM parks WHERE ParkCode=\"$ParkCode\"");
		if ($Parks != false && $Parks->rowCount()) {
			$temp = $Parks->fetch();
			if (gettype($temp) == gettype(array())) {
				$Park = array_merge($Park, $temp);
				$ParkRatings = executeQuery("SELECT ROUND(Avg(Rating),0) FROM reviews WHERE ParkID={$Park['ID']}");
				if ($ParkRatings != false && $ParkRatings->rowCount()) {
					$temp = $ParkRatings->fetch();
					if (ctype_digit($temp[0])) {
						$Park['RatingAvg'] = intval($temp[0]);
					}
				}
			}
		}
		
	?>
	
    <div class="row">

        <div class="one columns">

            <h3>Park information</h3>

            <div class="park-location">
				<?php if ($Park['ID'] > 0) { ?>
					<div id="park-map"></div>
					<script>
						function initMap() {
							var location = {
								lat: <?php echo $Park['Latitude']; ?>,
								lng: <?php echo $Park['Longitude']; ?>
							};
							var map = new google.maps.Map(document.getElementById('park-map'), {
								zoom: 14,
								center: location
							});
							var marker = new google.maps.Marker({
								position: location,
								map: map
							});
						}
					</script>
					<script
						async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_iTOki0siv_6GfltBuY3oXx5mfeLaRZ4&callback=initMap">
					</script>
					<br>
				<?php } ?>
            </div>


        </div>

        <div class="row">

            <div class="two columns">

                <div class="park-information">
					<?php
						if ($Park['ID'] > 0) {
							echo '<h4>'.$Park['Name'].'</h4>';

							echo '<h5>Street:</h5>';
							echo '<p>'.$Park['Street'].'</p>';

							echo '<h5>Suburb:</h5>';
							echo '<p>'.$Park['Suburb'].'</p>';

							echo '<h5>Average Rating:</h5>';
							echo '<p>';
							echoStars($Park['RatingAvg']);
							echo '</p>';
							
						} else {
							echo '<h4>Unknown Park.</h4>';
						}
					?>
                </div>


            </div>

            <div class="two columns">

                <?php
                $errors = array();
                if (isset($_POST['txtcomment'])) {
                    require 'server/includes/validate.inc';
                    validateReview($errors, $_POST, 'txtcomment');

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
                        include 'server/includes/addReview.inc';
                    } else {
                        echo 'Form submitted successfully with no errors. Great success!';
                    }
                } else {
                    include 'server/includes/addReview.inc';
                }
                ?>

            </div>

        </div>

        <div class="row">

            <div class="one column">

                <div class="park-reviews">
                    <h4>Reviews</h4>
					<?php
						$Reviews = array();
						if ($Park['ID'] > 0) {
							$Reviews2 = executeQuery("SELECT members.FirstName, members.LastName, reviews.Rating, reviews.Desc FROM reviews, members WHERE members.ID = reviews.UserID AND ParkID=\"{$Park['ID']}\" ORDER BY Rating DESC");
							if ($Reviews2 != false && $Reviews2->rowCount()) {
								$Reviews = $Reviews2;
							}
						}
						if (count($Reviews) <= 0) {
							echo '<div><h5>No reviews have been submitted for this park.</h5></div>';
						}
						else {
							foreach ($Reviews as $Review) {
								echo '<div>';
								echo '<h5>'.$Review['FirstName'].' '.$Review['LastName'].' ';
								echoStars($Review['Rating']);
								echo '</h5>';
								echo '<p>'.$Review['Desc'].'</p>';
								echo '</div>';
							}
						}
					?>
                </div>

            </div>


        </div>


    </div>
    <!-- Footer
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <?php include('includes/footer.inc'); ?>


    <!-- End Document
–––––––––––––––––––––––––––––––––––––––––––––––––– -->
</div>

</body>

</html>
