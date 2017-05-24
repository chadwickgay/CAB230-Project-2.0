<?php

global $db_host;
global $db_name;
global $db_username;
global $db_password;

$db_host = "localhost";
$db_name = 'parksearch';
//$db_username = 'parkuser';
//$db_password = 'password';
$db_username = 'root';
$db_password = '';

try {
    global $pdo;
    $pdo = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

function generate_uid() {
	return uniqid('', true);
}

function submitReview($UserID, $ParkID, $Description, $Rating) {
	try {
		global $pdo;
		$stmt = $pdo->prepare("DELETE FROM parksearch.reviews WHERE UserID=:UserID");
		$stmt->bindValue(':UserID', $UserID);
		$stmt->execute();
		$stmt = $pdo->prepare("INSERT INTO parksearch.reviews (ParkID, UserID, DatePosted, Rating, Description) VALUES (:ParkID, :UserID, :Date, :Rating, :Description)");
		$stmt->bindValue(':ParkID', $ParkID);
		$stmt->bindValue(':UserID', $UserID);
		$stmt->bindValue(':Date', date('Y-m-d', time()));
		$stmt->bindValue(':Rating', $Rating);
		$stmt->bindValue(':Description', $Description);
		$stmt->execute();
		
		return true;
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	return false;
}

function login($email, $password) {
	try {
		global $pdo;
		$stmt = $pdo->prepare('SELECT ID FROM parksearch.members WHERE Email=:email AND Password=SHA2(CONCAT(:password, Salt), 0)');
		$stmt->bindValue(':email', $email);
		$stmt->bindValue(':password', $password);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			$temp = $stmt->fetch();
			if (ctype_digit($temp[0])) {
				$id = intval($temp[0]);
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
				$_SESSION['logged'] = $id;
				return true;
			}
		}
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	return false;
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

function getParkLatLong($parkName, $suburb){
  global $pdo;

  // Add ratings to the search
  // Join reviews table

  try {
      $sql = 'SELECT DISTINCT Name, Latitude, Longitude
              FROM parksearch.parks
              WHERE Suburb LIKE CONCAT("%", :suburb, "%") AND Name LIKE CONCAT("%", :name, "%")';
      $query = $pdo->prepare($sql);
      $query->bindParam(':suburb', $suburb);
      $query->bindParam(':name', $parkName);
      $query->execute();
      $results = $query->fetchAll();

  } catch (PDOException $ex) {
      echo $ex->getMessage();
  }

  return $results;
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
