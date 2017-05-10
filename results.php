
<?php
include("server/PHP/master.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Park Search - Results</title>
    <meta name="description" content="">
    <meta name="author" content="Chadwick Gay">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Crete+Round' rel='stylesheet' type='text/css'>

    <!-- JS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script type="text/javascript" src="scripts/script.js"></script>
</head>

<body>

    <div class="container">

        <!-- Page Navigation
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('includes/nav.inc'); ?>

        <!-- Main Content
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <h3>Search results</h3>
        <div class="container">

            <div class="row">

                <div class="one columns">


                    <div id="results-map"></div>

                    <script>
                        function initMap() {
                            var location = {
                                lat: -27.38006149,
                                lng: 153.0387005
                            };
                            var map = new google.maps.Map(document.getElementById('results-map'), {
                                zoom: 15,
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
                </div>
                
                <div class="one columns">

                    <?php
                    $pdo = new PDO('mysql:host=localhost;dbname=parksearch', 'parkuser', 'password');
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    try
                    {
                        $result = $pdo->query('SELECT ParkCode, Name, Street, Suburb '.
                            'FROM Parks ' .
                            'LIMIT 10');
                    }
                    catch (PDOException $e)
                    {
                        echo $e->getMessage();
                    }

                    echo '<table>';

                    echo '<tr>';
                    echo '<th>PARK CODE</th><th>PARK NAME</th><th>STREET</th><th>SUBURB</th>';
                    echo '</tr>';

                    foreach ($result as $park)
                    {

                        echo "<td>{$park['ParkCode']}</td><td>{$park['Name']}</td><td>{$park['Street']}</td><td>{$park['Suburb']}</td>";
                        echo '</tr>';
                    }
                    echo '</table>';
                    ?>

                    <!--
                    
                    <br><br>

                    <table>

                        <tr>
                            <th>PARK CODE</th>
                            <th>PARK NAME</th>
                            <th>STREET</th>
                            <th>SUBURB</th>
                            <th>RATING</th>
                        </tr>
                        <tr>
                            <td>D0228</td>
                            <td><a href="park.php">A.R.C.HILL PARK</td>
                            <td>GOSS RD</td>
                            <td>VIRGINIA</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>D0021</td>
                            <td>A. J. JONES RECREATION RESERVE</td>
                            <td>CORNWALL ST</td>
                            <td>GREENSLOPES</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>D0696</td>
                            <td>A. J. JONES RECREATION RESERVE</td>
                            <td>CORNWALL ST</td>
                            <td>GREENSLOPES</td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td>D0432</td>
                            <td>ABBEVILLE STREET PARK</td>
                            <td>ABBEVILLE ST</td>
                            <td>UPR MT GRAVATT</td>
                            <td>5</td>
                        </tr>

                    </table>

                </div>
				<br>
			</div>
		</div> -->

        <!-- Footer
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->

        <?php include('includes/footer.inc'); ?>


        <!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    </div>


</body>

</html>
