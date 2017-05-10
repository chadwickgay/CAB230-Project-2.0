<div class="park-review">

    <h4>Enter your review</h4>

    <form method="POST" action="../Project/park.php" name="park-review">

        <div class="park-review">

            <div class="rating">
                <input type="radio" id="rating5" name="rating">
                <label for="rating5"> &#9733;</label>
                <input type="radio" id="rating4" name="rating">
                <label for="rating4">&#9733;</label>
                <input type="radio" id="rating3" name="rating">
                <label for="rating3">&#9733;</label>
                <input type="radio" id="rating2" name="rating">
                <label for="rating2">&#9733;</label>
                <input type="radio" id="rating1" name="rating">
                <label for="rating1">&#9733;</label>
            </div>
            <br>
            <textarea cols="50" rows="4" name="txtcomment" placeholder="Enter your review here."></textarea>
            <span id="txtcommentErr"></span>

        </div>
        <input type="submit" value="Submit" onclick="return validateReview()">
    </form>

</div>