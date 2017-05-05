<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Individual Park Page</title>
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

        <!-- Page Header
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <header>
            <div class="header">
                <!-- FIX THIS -->
                <h1>Park Search</h1>
                <nav>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="browse.html">Browse</a></li>
                        <li><a href="create-account.html">Create Account</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="results.html">Results</a></li>
                        <li><a href="park.html">Park</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- Main Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <div class="row">

            <div class="two columns">

                <div class="park-information">

                    <h4>Information</h4>

                    <p><strong>Street: </strong>Goss Road</p>

                    <p><strong>Suburb:</strong> Virginia</p>

                    <p><strong>Average Rating: </strong>&#9733;&#9733;&#9733;</p>

                </div>

                <div>
                    <h4>Reviews</h4>
                    <div>
                        <h5>John Smith &#9733; &#9733; &#9733;</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac leo sit amet lectus placerat feugiat ut id nunc. Vestibulum mattis augue dolor, ac elementum tellus luctus laoreet.</p>
                    </div>
                    <div>
                        <h5>Jane Smith &#9733;&#9733;&#9733;&#9733;</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>

                    <div>
                        <h5>Billy Joe &#9733; &#9733; &#9733; &#9733; &#9733;</h5>
                        <p>Pellentesque nisi dolor, facilisis non arcu at, convallis dapibus quam. Cras mattis velit quis nisi tempus lobortis. Cras feugiat ornare lorem, ac volutpat felis sodales et. Curabitur lobortis, nunc a dignissim malesuada.</p>
                    </div>
                </div>
            </div>

            <div class="two columns">

                <h4>Location</h4>
                <div id="park-map"></div>
                <script>
                    function initMap() {
                        var location = {
                            lat: -27.38006149,
                            lng: 153.0387005
                        };
                        var map = new google.maps.Map(document.getElementById('park-map'), {
                            zoom: 14,
                            center: location
                        });
                        var marker = new google.maps.Marker({
                            position: location,
                            map: map
                        });
                    }

                </script>
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_iTOki0siv_6GfltBuY3oXx5mfeLaRZ4&callback=initMap">


                </script>

                <br>

                <h4>Enter your review</h4>

                <form method="POST">

                    <div class="review-input">

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
                        <textarea cols="50" rows="4" name="review-text" placeholder="Enter your review here."></textarea>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
        <!-- Footer
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('includes/footer.inc'); ?>



        <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    </div>

</body>

</html>
