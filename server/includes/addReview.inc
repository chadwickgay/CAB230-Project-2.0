<div class="park-review">
    <h4>ENTER YOUR REVIEW</h4>

    <?php
    if (!isset($_SESSION['logged'])) {
        echo "<p>You be logged in to leave a review.<p>";
    }
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>

    <?php $parkCode = htmlspecialchars(isset($_GET['ParkCode']) ? $_GET['ParkCode'] : ""); ?>

    <form method="POST" action="park.php?ParkCode=<?php echo $parkCode; ?>" name="park-review"
          onsubmit="<?php echo isset($_SESSION['logged']) ? 'return validateReview();' : 'return redirectToLogin();' ?>">
        <fieldset>

            <legend>Select a star rating</legend>

            <div class="park-review">

                <div class="rating">

                    <!-- Generate ratings fields -->
                    <?php createRatingsField(); ?>
				</div>
				
				<br>

                <!-- Generate label for review textarea  -->
                <?php createLabel("txtcomment", "Enter review comments"); ?>

                <!-- Text area to allow for user input review comments -->
                <textarea cols="50" rows="4" name="txtcomment" id="txtcomment"
                          placeholder="Enter your review here." <?php echo isset($_SESSION['logged']) ? '' : 'disabled' ?>></textarea>

                <!-- Generate error label to contain error messages  -->
                <?php createErrorLabel("txtcommentErr"); ?>

            </div>

            <input type="submit" value="<?php echo isset($_SESSION['logged']) ? 'Submit' : 'Login' ?>">

        </fieldset>
    </form>
</div>
