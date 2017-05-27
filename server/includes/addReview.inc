<div class="park-review">

    <h4>Enter your review</h4>
    <?php
    if (!isset($_SESSION['logged'])) {
        echo "You must be logged in to leave a review.";
    }
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    ?>
    <?php $ParkCode = htmlspecialchars(isset($_GET['ParkCode']) ? $_GET['ParkCode'] : ""); ?>
    <form method="POST" action="park.php?ParkCode=<?php echo $ParkCode; ?>" name="park-review"
          onsubmit="<?php echo isset($_SESSION['logged']) ? 'return validateReview();' : 'return redirectToLogin();' ?>">

        <div class="park-review">

            <div class="rating">
                <input type="checkbox" id="rating5" name="rating" value=5
                       onclick='checkboxDeselectOthers(this);' <?php echo isset($_SESSION['logged']) ? '' : 'disabled' ?>>
                <label for="rating5"> &#9733;</label>
                <input type="checkbox" id="rating4" name="rating" value=4
                       onclick='checkboxDeselectOthers(this);' <?php echo isset($_SESSION['logged']) ? '' : 'disabled' ?>>
                <label for="rating4">&#9733;</label>
                <input type="checkbox" id="rating3" name="rating" value=3
                       onclick='checkboxDeselectOthers(this);' <?php echo isset($_SESSION['logged']) ? '' : 'disabled' ?>>
                <label for="rating3">&#9733;</label>
                <input type="checkbox" id="rating2" name="rating" value=2
                       onclick='checkboxDeselectOthers(this);' <?php echo isset($_SESSION['logged']) ? '' : 'disabled' ?>>
                <label for="rating2">&#9733;</label>
                <input type="checkbox" id="rating1" name="rating" value=1
                       onclick='checkboxDeselectOthers(this);' <?php echo isset($_SESSION['logged']) ? '' : 'disabled' ?>>
                <label for="rating1">&#9733;</label>
            </div>
            <br>
            <textarea cols="50" rows="4" name="txtcomment"
                      placeholder="Enter your review here." <?php echo isset($_SESSION['logged']) ? '' : 'disabled' ?>></textarea>
            <span id="txtcommentErr"></span>

        </div>
        <input type="submit" value="<?php echo isset($_SESSION['logged']) ? 'Submit' : 'Login' ?>">
    </form>

</div>
