<div class="row">
    <div class="four columns">
		<?php createFormOpeningTag("GET", "browse.php", "browse-name", ""); ?>
			<?php createLabel("park-name", "Park Name"); ?>
            <input type="text" name="park-name" id="park-name" placeholder="Enter park name"/>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="four columns">
		<?php createFormOpeningTag("GET", "browse.php", "browse-suburb", ""); ?>
			<?php createLabel("suburb", "Suburb"); ?>
            <?php populateSuburbMenu(); ?>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="four columns">

		<?php createFormOpeningTag("GET", "browse.php", "browse-rating", ""); ?>

        <?php

        $ratingOptions = array(
                                "Zero Stars",
                                "&#9733;",
                                "&#9733; &#9733;",
                                "&#9733; &#9733; &#9733;",
                                "&#9733; &#9733; &#9733; &#9733;",
                                "&#9733; &#9733; &#9733; &#9733; &#9733;");

        createSelectField("rating", "Minimum Park Rating", "rating", "", $ratingOptions,"rating-search")

        ?>
			<input type="submit" value="Submit">
		</form>
    </div>

    <div class="four columns">
		<?php createFormOpeningTag("GET", "browse.php", "browse-distance", ""); ?>
            <div id="get-location">
				<?php createLabeL("near-me", "Use current location"); ?>
                <button type="button" id="near-me" onclick="getLocation()">Use my location!</button>
            </div>
			
            <div id="distance-block" class="hidden">
                <?php

                $values = array(0.5,1,2.5,5,10,20);

                $options = array("≤ 0.5km", "≤ 1km", "≤ 2.5km", "≤ 5km", "≤ 10km", "≤ 20km");

                createDistanceDropDown("distance", "Distance", "distance", $options, $values)

                ?>
                <input type="submit" value="Submit" id="distance-submit">
            </div>



            <input type="hidden" name="lat" id="lat"/>
            <input type="hidden" name="long" id="long"/>
        </form>
    </div>
</div>

