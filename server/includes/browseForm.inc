<div clas="row">
    <div class="four columns">
        <form method="GET" action="browse.php" name="browse-name">

            <label for="park-name">Park Name</label>
            <input type="text" name="park-name" placeholder="Enter park name"/>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="four columns">
        <form method="GET" action="browse.php" name="browse-suburb">
            <label for="suburb">Suburb</label>
            <?php populateSuburbMenu(); ?>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="four columns">
        <form method="GET" action="browse.php" name="browse-rating">
            <label for="rating">Park Rating</label>
            <select class="rating-select" name="rating" id="rating">
                <option value="" disabled selected style="display: none;">Select rating</option>
                <option value="0">0</option>
                <option value="1">&#9733;</option>
                <option value="2">&#9733; &#9733;</option>
                <option value="3">&#9733; &#9733; &#9733;</option>
                <option value="4">&#9733; &#9733; &#9733; &#9733;</option>
                <option value="5">&#9733; &#9733; &#9733; &#9733; &#9733;</option>
            </select>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="four columns">
        <form method="GET" action="browse.php" name="browse-distance">
            <div id="get-location">
                <label for="near-me">Use current location</label>
                <button type="button" onclick="getLocation()">Use my location!</button>
            </div>
            <div id="distance-block" class="hidden">
                <label for="distance-select">Distance</label>
                <select name="distance" id="distance">
                    <option value="" disabled selected style="display: none;">Select distance</option>
                    <option value="1">1 Km</option>
                    <option value="2">2 Km</option>
                    <option value="3">3 Km</option>
                    <option value="4">4 Km</option>
                    <option value="5">5 Km</option>
                </select>
                <input type="submit" value="Submit" id="distance submit">
            </div>

            <input type="hidden" name="lat" id="lat"/>
            <input type="hidden" name="long" id="long"/>
        </form>
    </div>
</div>


<!--

<form method="GET" action="browse.php" name="browse">

    <div class="row">

        <div class="two columns">



            <br>
        </div>

        <div class="two columns">


            <br>




        </div>

    </div>
    <div class="one column">


    </div>

</form>
-->
