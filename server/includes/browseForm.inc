<form method="GET" action="browse.php" name="browse">

    <div class="row">

        <div class="two columns">

            <label for="park-name">Park Name</label>
            <input type="text" name="park-name" placeholder="Central Park"/>
            <br>

            <label for="suburb">Suburb</label>
            <?php populateSuburbMenu();?>
            <br>
        </div>

        <div class="two columns">

            <label for="rating">Park Rating</label>
            <select class="rating-select" name="rating" id="rating">
                <option value="" disabled selected style="display: none;">select</option>
                <option value="1">&#9733;</option>
                <option value="2">&#9733; &#9733;</option>
                <option value="3">&#9733; &#9733; &#9733;</option>
                <option value="4">&#9733; &#9733; &#9733; &#9733;</option>
                <option value="5">&#9733; &#9733; &#9733; &#9733; &#9733;</option>
            </select>
            <br>
            <!--
            <label for="near-me">Use current location</label>
            <button id="near-me">Find parks near me</button>
          -->
        </div>

    </div>

    <div class="one column">
        <input type="submit" value="Submit">

    </div>

</form>

<div class="one column">
  <br>
  <hr>
  <br>
  <form>

    <label for="rating">Distance</label>
    <select class="distance-select" name="distance" id="distance">
        <option value="" disabled selected style="display: none;">select</option>
        <option value="1">1 Km</option>
        <option value="2">2 Km</option>
        <option value="3">3 Km</option>
        <option value="4">4 Km</option>
        <option value="5">5 Km</option>
    </select>

  <label for="near-me">Use current location</label>
  <input type="submit" value="Find parks near me" onclick="getLocation()">

  </form>

</div>
