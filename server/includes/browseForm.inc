<form method="GET" action="browse.php" name="browse-name">

  <label for="park-name">Park Name</label>
  <input type="text" name="park-name" placeholder="Central Park"/>
  <input type="submit" value="Submit">
</form>

<form method="GET" action="browse.php" name="browse-suburb">
  <label for="suburb">Suburb</label>
  <?php populateSuburbMenu();?>
  <input type="submit" value="Submit">
</form>

<form method="GET" action="browse.php" name="browse-rating">
  <label for="rating">Park Rating</label>
  <select class="rating-select" name="rating" id="rating">
      <option value="" disabled selected style="display: none;">select</option>
      <option value="1">&#9733;</option>
      <option value="2">&#9733; &#9733;</option>
      <option value="3">&#9733; &#9733; &#9733;</option>
      <option value="4">&#9733; &#9733; &#9733; &#9733;</option>
      <option value="5">&#9733; &#9733; &#9733; &#9733; &#9733;</option>
  </select>
  <input type="submit" value="Submit">
</form>

<form method="GET" action="browse.php" name="browse-distance">

  <label for="near-me">Use current location</label>
  <button type="button" onclick="getLocation()">Use my location!</button>

  <label for="rating">Distance</label>
  <select class="distance-select" name="distance" id="distance" disabled>
      <option value="" disabled selected style="display: none;">select</option>
      <option value="1">1 Km</option>
      <option value="2">2 Km</option>
      <option value="3">3 Km</option>
      <option value="4">4 Km</option>
      <option value="5">5 Km</option>
  </select>

  <input type="submit" value="Submit">

  <input type="hidden" name="lat" id="lat"/>
  <input type="hidden" name="long" id="long"/>
</form>


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
