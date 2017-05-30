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
                <?php createLabel("distance", "Distance") ?>
                <select name="distance" id="distance">
                    <option value="DEFAULT" disabled selected class="hidden">Select distance</option>
                    <option value="1">1 Km</option>
                    <option value="2">2 Km</option>
                    <option value="3">3 Km</option>
                    <option value="4">4 Km</option>
                    <option value="5">5 Km</option>
                    <option value="10">10 Km</option>
                    <option value="15">15 Km</option>
                    <option value="25">25 Km</option>
                    <option value="50">50 Km</option>
                    <option value="100">100 Km</option>
                </select>
                <input type="submit" value="Submit" id="distance-submit">
            </div>

            <input type="hidden" name="lat" id="lat"/>
            <input type="hidden" name="long" id="long"/>
        </form>
    </div>
</div>

