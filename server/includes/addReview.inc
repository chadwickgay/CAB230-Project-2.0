<div class="park-review">
    <h4>ENTER YOUR REVIEW</h4>

    <?php
    if (!isset($_SESSION['logged'])) {
        echo "<p>You need to be logged in to leave a review.<p>";
    }
	
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
	
	$parkCode = htmlspecialchars(isset($_GET['ParkCode']) ? $_GET['ParkCode'] : "");
	createAddReviewFormOptionOne($parkCode);
	?>
</div>