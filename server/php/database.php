<?php
global $db_name;
$db_name = 'parksearch';
global $db_username;
//$db_username = 'root';
$db_username = 'parkuser';
global $db_password;
//$db_password = '';
$db_password = 'password';
global $db_host;
$db_host = "localhost";

try {
	global $pdo;
    $pdo = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

function generate_uid() {
	return uniqid('', true);
}

function populateSuburbMenu() {
    global $pdo;
    $result = $pdo->query('SELECT DISTINCT Suburb FROM parksearch.parks ORDER BY Suburb;');
    echo('
        <select name="suburb" class="suburb-select">
        <option disabled selected style="...">select</option>
    ');

    foreach($result as $suburb) {
        echo '<option value="' . $suburb['Suburb'] . '">' . $suburb['Suburb'] . '</option>';
    }
        echo '</select>';
}

function getParksWithinRange($userLatitude, $userLongitude, $userDistance){
  global $pdo;

  try {
      $sql = 'SELECT DISTINCT ParkCode, Name, Street, Suburb, (
        6371 * acos (
          cos ( radians(:userLatitude) )
          * cos( radians( Latitude ) )
          * cos( radians( Longitude ) - radians(:userLongitude) )
          + sin ( radians(:userLatitude) )
          * sin( radians( Latitude ) )
        )
      ) AS distance
              FROM parksearch.parks
              HAVING distance < :userDistance';
      $query = $pdo->prepare($sql);
      $query->bindParam(':userLatitude', $userLatitude);
      $query->bindParam(':userLongitude', $userLongitude);
      $query->bindParam(':userDistance', $userDistance);
      $query->execute();
      $results = $query->fetchAll();

      // Call outputSearchResults to output results table
      outputSearchResults($results);

  } catch (PDOException $ex) {
      echo $ex->getMessage();
  }
}

function showAllParks() {
    global $pdo;

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
}

function searchForParks($parkName, $suburb) {

    global $pdo;

    // Add ratings to the search
    // Join reviews table

    try {
        $sql = 'SELECT DISTINCT ParkCode, Name, Street, Suburb
                FROM parksearch.parks
                WHERE Suburb LIKE CONCAT("%", :suburb, "%") AND Name LIKE CONCAT("%", :name, "%")';
        $query = $pdo->prepare($sql);
        $query->bindParam(':suburb', $suburb);
        $query->bindParam(':name', $parkName);
        $query->execute();
        $results = $query->fetchAll();

        // Call outputSearchResults to output results table
        outputSearchResults($results);

    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }
}

function outputSearchResults($results){
    echo '<table>';

    echo '<tr>';
    echo '<th>PARK CODE</th><th>PARK NAME</th><th>STREET</th><th>SUBURB</th>';
    echo '</tr>';

    foreach ($results as $park)
    {
        echo "<td>{$park['ParkCode']}</td><td><a href='park.php?ParkCode={$park['ParkCode']}'>{$park['Name']}</a></td><td>{$park['Street']}</td><td>{$park['Suburb']}</td>";
        echo '</tr>';
    }

    echo '</table>';
}

?>
