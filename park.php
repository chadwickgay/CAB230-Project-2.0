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

    <!-- Page Navigation
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <?php include('includes/nav.inc'); ?>

    <!-- Main Content
–––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <div class="row">

        <div class="one columns">

            <h3>Park information</h3>

            <div class="park-location">

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
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_iTOki0siv_6GfltBuY3oXx5mfeLaRZ4&callback=initMap">


                </script>

                <br>

            </div>


        </div>

        <div class="row">

            <div class="two columns">

                <div class="park-information">

                    <h4>A.R.C.HILL PARK</h4>

                    <h5>Street:</h5>
                    <p>Goss Road</p>

                    <h5>Suburb:</h5>
                    <p> Virginia</p>

                    <h5>Average Rating: </h5>
                    <p class="star">&#9733;&#9733;&#9733;</p>

                </div>


            </div>

            <div class="two columns">

                <?php include('includes/addReview.inc'); ?>

            </div>

        </div>

        <div class="row">

            <div class="one column">

                <div class="park-reviews">
                    <h4>Reviews</h4>
                    <div>
                        <h5>John Smith <span class="star">&#9733; &#9733; &#9733;</span></h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ac leo sit amet lectus
                            placerat feugiat ut id nunc. Vestibulum mattis augue dolor, ac elementum tellus luctus
                            laoreet.</p>
                    </div>
                    <div>
                        <h5>Jane Smith <span class="star">&#9733;&#9733;&#9733;&#9733;</span></h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>

                    <div>
                        <h5>Billy Joe <span class="star">&#9733; &#9733; &#9733; &#9733; &#9733;</span></h5>
                        <p>Pellentesque nisi dolor, facilisis non arcu at, convallis dapibus quam. Cras mattis velit
                            quis
                            nisi tempus lobortis. Cras feugiat ornare lorem, ac volutpat felis sodales et. Curabitur
                            lobortis, nunc a dignissim malesuada.</p>
                    </div>
                </div>

            </div>


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