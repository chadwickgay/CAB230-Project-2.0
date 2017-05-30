<?php
include("server/PHP/database.php");
include("server/PHP/formFunctions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Basic Page Needs -->
	<?php include('server/includes/head.inc'); ?>
	<title>Park Search - Park</title>

	<!-- JS -->
	<script type="text/javascript" src="scripts/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_iTOki0siv_6GfltBuY3oXx5mfeLaRZ4"></script>
	<script type="text/javascript" src="scripts/validation.js"></script>
</head>

<body>
	<div class="container">
		<!-- Header & Page Navigation -->
		<?php include('server/includes/nav.inc'); ?>
		
		<!-- Main Content -->
		<?php
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
				echo '</span>';
				echo "<div itemprop='reviewRating' itemscope itemtype='http://schema.org/Rating'>
				<meta itemprop='worstRating' content='0'>
				<span itemprop='ratingValue'>$numberOfStars</span> out of <span itemprop='bestRating'>5</span> stars
				</div>";
			}
			
		}

		function displayAggregateStars($numberOfStars) {
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
				echo '</span>';
				echo "<div>
				  <span>$numberOfStars</span> out of <span>5</span> stars
				  </div>";
			}
			
		}
		
		$ParkCode = htmlspecialchars(isset($_GET['ParkCode']) ? $_GET['ParkCode'] : "");
		$Park = array('ID' => -1, 'RatingAvg' => -1);
		$Parks = $pdo->prepare("SELECT ID, ParkCode, Name, Street, Suburb, Easting, Northing, Latitude, Longitude FROM items WHERE ParkCode=:parkcode");
		$Parks->bindValue(':parkcode', $ParkCode);
		$Parks->execute();
		if ($Parks != false && $Parks->rowCount()) {
			$temp = $Parks->fetch();
			if (gettype($temp) == gettype(array())) {
				$Park = array_merge($Park, $temp);
				$ParkRatings = $pdo->prepare("SELECT ROUND(Avg(Rating),0) FROM reviews WHERE ParkID=:parkid");
				$ParkRatings->bindValue(':parkid', $Park['ID']);
				$ParkRatings->execute();
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
						var latitude = <?php echo $Park['Latitude']; ?>;
						var longitude = <?php echo $Park['Longitude']; ?>;
						
						initMap(latitude, longitude);
					</script>
					<br>
					<?php } ?>
				</div>
			</div>
			
			<div class="row">
				<div class="two columns">
					<div class="park-information" itemscope itemtype="http://schema.org/Place">
						<?php
						if ($Park['ID'] > 0) {
							echo '<h4 itemprop="name">' . $Park['Name'] . '</h4>';
							echo '<h5>Street:</h5>';
							echo '<p itemprop="address">' . $Park['Street'] . '</p>';
							echo '<h5>Suburb:</h5>';
							echo '<p itemprop="address">' . $Park['Suburb'] . '</p>';
							echo '<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">';
							echo '<p class="hidden" itemprop="latitude">' . $Park['Latitude'] . '</p>';
							echo '<p class="hidden" itemprop="longitude">' . $Park['Longitude'] . '</p>';
							echo '</div>';
							echo '<h5>Average Rating:</h5>';
							displayAggregateStars($Park['RatingAvg']);
						} else {
							echo '<h4>Unknown Park.</h4>';
						}
						?>
					</div>
				</div>
				
				<div class="two columns">
					<?php
					$errors = array();
					if (isset($_POST['txtcomment']) && isset($_SESSION['logged'])) {
						require 'server/includes/validate.inc';
						validateReview($errors, $_POST, 'txtcomment');

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
                            include 'server/includes/addReview.inc';
                        } else {
                            $rating = 0;

                            if (isset($_POST['rating'])) {
                                // Sanitize input
                                $rating = sanitizeInput($_POST['rating']);
                            }

                            // Sanitize input
                            $reviewComment = sanitizeInput($_POST['txtcomment']);
                            $logged = $_SESSION['logged'];
                            $parkID = $Park['ID'];

                            submitReview($logged, $parkID, $reviewComment, $rating);

                            echo "Your review has been submitted.";
                            echo "<script>redirectToPage('/park.php?ParkCode=" . $Park['ParkCode'] . "');</script>";
                        }
					}
                    else {
						include 'server/includes/addReview.inc';
					}
					?>
				</div>
			</div>
			
			<div class="row">
				<div class="one column">
					<div class="park-reviews" itemscope itemtype="http://schema.org/Review">
						<?php
						echo '<br /><hr />';
						echo '<h4 itemprop="itemReviewed">REVIEWS FOR ' . $Park['Name'] . '</h4>';
						
						$Reviews = array();
						
						if ($Park['ID'] > 0) {
							$Reviews2 = $pdo->prepare("SELECT members.FirstName, members.LastName, reviews.Rating, reviews.Description FROM reviews, members WHERE members.ID = reviews.UserID AND ParkID=:parkid ORDER BY Rating DESC");
							$Reviews2->bindValue(':parkid', $Park['ID']);
							$Reviews2->execute();
							if ($Reviews2 != false && $Reviews2->rowCount()) {
								$Reviews = $Reviews2;
							}
						}
						if (count($Reviews) <= 0) {
							echo '<div><h5>No reviews have been submitted for this park.</h5></div>';
						} else {
							foreach ($Reviews as $Review) {
								echo '<div>';
								echo '<h5 itemprop="author">' . $Review['FirstName'] . ' ' . $Review['LastName'] . ' ';
								echo '</h5>';
								echo '</div>';
								echo '<div>';
								echoStars($Review['Rating']);
								echo '</div>';
								echo '<p itemprop="reviewBody">' . $Review['Description'] . '</p>';
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Footer -->
		<?php include('server/includes/footer.inc'); ?>
		
		<!-- End Document -->
	</div>
</body>

</html>
