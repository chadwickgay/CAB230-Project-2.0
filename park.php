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
                echo '</span>';
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
		
		$parkCode = htmlspecialchars(isset($_GET['ParkCode']) ? $_GET['ParkCode'] : "");
		$park = array('ID' => -1, 'RatingAvg' => -1);
		$parks = $pdo->prepare("SELECT ID, ParkCode, Name, Street, Suburb, Easting, Northing, Latitude, Longitude FROM items WHERE ParkCode=:parkcode");
		$parks->bindValue(':parkcode', $parkCode);
		$parks->execute();
		if ($parks != false && $parks->rowCount()) {
			$temp = $parks->fetch();
			if (gettype($temp) == gettype(array())) {
				$park = array_merge($park, $temp);
				$parkRatings = $pdo->prepare("SELECT ROUND(Avg(Rating),0) FROM reviews WHERE ParkID=:parkid");
				$parkRatings->bindValue(':parkid', $park['ID']);
				$parkRatings->execute();
				if ($parkRatings != false && $parkRatings->rowCount()) {
					$temp = $parkRatings->fetch();
					if (ctype_digit($temp[0])) {
						$park['RatingAvg'] = intval($temp[0]);
					}
				}
			}
		}	
		?>
		
		<div class="row">
			<div class="one columns">
				<h3>Park information</h3>
				
				<div class="park-location">
					<?php if ($park['ID'] > 0) { ?>
					<div id="park-map"></div>
					<script>
						var latitude = <?php echo $park['Latitude']; ?>;
						var longitude = <?php echo $park['Longitude']; ?>;
						
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
						if ($park['ID'] > 0) {
							echo '<h4 itemprop="name">' . $park['Name'] . '</h4>';
							echo '<h5>Street:</h5>';
							echo '<p itemprop="address">' . $park['Street'] . '</p>';
							echo '<h5>Suburb:</h5>';
							echo '<p itemprop="address">' . $park['Suburb'] . '</p>';
							echo '<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">';
							echo '<p class="hidden" itemprop="latitude">' . $park['Latitude'] . '</p>';
							echo '<p class="hidden" itemprop="longitude">' . $park['Longitude'] . '</p>';
							echo '</div>';
							echo '<h5>Average Rating:</h5>';
							displayAggregateStars($park['RatingAvg']);
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
                            $parkID = $park['ID'];

                            submitReview($logged, $parkID, $reviewComment, $rating);

                            echo "Your review has been submitted.";
                            echo "<script>redirectToPage('/park.php?ParkCode=" . $park['ParkCode'] . "');</script>";
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
						echo '<h4 itemprop="itemReviewed">REVIEWS FOR ' . $park['Name'] . '</h4>';
						
						$reviews = array();
						
						if ($park['ID'] > 0) {
							$reviews2 = $pdo->prepare("SELECT members.FirstName, members.LastName, reviews.Rating, reviews.Description FROM reviews, members WHERE members.ID = reviews.UserID AND ParkID=:parkid ORDER BY Rating DESC");
							$reviews2->bindValue(':parkid', $park['ID']);
							$reviews2->execute();
							if ($reviews2 != false && $reviews2->rowCount()) {
								$reviews = $reviews2;
							}
						}
						if (count($reviews) <= 0) {
							echo '<div><h5>No reviews have been submitted for this park.</h5></div>';
						} else {
							foreach ($reviews as $review) {
								echo '<div>';
								echo '<h5 itemprop="author">' . $review['FirstName'] . ' ' . $review['LastName'] . ' ';
								echo '</h5>';
								echo '</div>';
								echo '<div>';
								echoStars($review['Rating']);
								echo '</div>';
								echo '<p itemprop="reviewBody">' . $review['Description'] . '</p>';
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
