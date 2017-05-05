<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Browse Parks Page</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>

    <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">

        <!-- Page Navigation
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('includes/nav.inc'); ?>

        <!-- Main Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <h3>Browse for parks</h3>
        <form>

            <div class="row">

                <div class="two columns">

                    <label for="park-name">Park Name</label>
                    <input type="text" placeholder="Central Park" id="park-name" /><br>

                    <label for="suburb">Suburb</label>
                    <select class="suburb-select" name="suburb" id="suburb">
                        <option value="" disabled selected style="display: none;">select</option>
                        <option value="1">7TH BRIGADE PARK</option>
                        <option value="2">A. J. JONES RECREATION RESERVE</option>
                        <option value="3">A.R.C.HILL PARK</option>
                        <option value="4">ABBEVILLE STREET PARK</option>
                </select><br>


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
                </select><br>

                    <label for="near-me">Use current location</label>
                    <button id="near-me">Find parks near me</button>
                </div>

            </div>

            <div class="one column">
                <input type="submit" value="Submit">
            </div>

        </form>


        <!-- Footer
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('includes/footer.inc'); ?>

        <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    </div>

</body>

</html>
