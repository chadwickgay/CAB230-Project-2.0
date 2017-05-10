<form>

    <div class="row">

        <div class="two columns">

            <label for="park-name">Park Name</label>
            <input type="text" placeholder="Central Park" id="park-name" />
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
                <option value="1">&#9733; &#9733;</option>
                <option value="1">&#9733; &#9733; &#9733;</option>
                <option value="1">&#9733; &#9733; &#9733; &#9733;</option>
                <option value="1">&#9733; &#9733; &#9733; &#9733; &#9733;</option>
            </select>
            <br>

            <label for="near-me">Use current location</label>
            <button id="near-me">Find parks near me</button>
        </div>

    </div>

    <div class="one column">
        <input type="submit" value="Submit">
    </div>

</form>