<?php

/*
 * ______ _____  ___ ______   ___  ___ _____
 * | ___ \  ___|/ _ \|  _  \  |  \/  ||  ___|
 * | |_/ / |__ / /_\ \ | | |  | .  . || |__
 * |    /|  __||  _  | | | |  | |\/| ||  __|
 * | |\ \| |___| | | | |/ /   | |  | || |___
 * \_| \_\____/\_| |_/___/    \_|  |_/\____/
 *
 * To connect to the FastApps server, you need to replace all of the "parksearch.table"
 * lines to the name of your database on the FastApps server, like this: "n9440488.table"
 * I don't think that we're all going to need to do this, but if for some reason we do,
 * make sure that you change it. Don't remove all of the stuff below, it's there so we can
 * quickly switch between them since it's going to change every time one of us pushes to
 * the repo.
*/

global $db_host;
global $db_name;
global $db_username;
global $db_password;

//$db_host = "localhost"; // FastApps
//$db_name = "n9440488"; // FastApps: Tom
//$db_username = "n9440488"; // FastApps: Tom
//$db_password = "tomchadken"; // FastApps

$db_host = "localhost";
$db_name = 'parksearch';
$db_username = 'parkuser';
$db_password = 'password';
//$db_username = 'root';
//$db_password = '';

//Whatever includes this file will have a sql database connection setup and ready to be used.
try {
    global $pdo;
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

//generates a random 64 char long string.
function generate_rand_string() {
    return uniqid('', true);
}

//Inserts a review into the database with the given parameters
function submitReview($UserID, $ParkID, $Description, $Rating) {
    try {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM reviews WHERE UserID=:UserID AND ParkID=:ParkID");
        $stmt->bindValue(':ParkID', $ParkID);
        $stmt->bindValue(':UserID', $UserID);
        $stmt->execute();
        $stmt = $pdo->prepare("INSERT INTO reviews (ParkID, UserID, DatePosted, Rating, Description) VALUES (:ParkID, :UserID, :Date, :Rating, :Description)");
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

//Checks that the email and password matches an account on record and returns true if login was successful.
//also starts a php session and sets the logged in session status.
function login($email, $password) {
    try {
        global $pdo;
        $stmt = $pdo->prepare('SELECT ID FROM members WHERE Email=:email AND Password=SHA2(CONCAT(:password, Salt), 0)');
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

//echos all the different suburbs present in the database enclosed in an option html tag
function populateSuburbMenu() {
    global $pdo;
    $result = $pdo->query('SELECT DISTINCT Suburb FROM items ORDER BY Suburb;');
    echo('
        <select name="suburb" class="suburb-select" id="suburb">
        <option alue="DEFAULT" disabled selected class="hidden">select</option>
    ');

    foreach ($result as $suburb) {
        echo '<option value="' . $suburb['Suburb'] . '">' . $suburb['Suburb'] . '</option>';
    }
    echo '</select>';
}

//returns all the parks that are within the distance from the given coordinates
function searchParksByDistance($userLatitude, $userLongitude, $userDistance) {

    global $pdo;

    try {
        $sql = 'SELECT DISTINCT ParkCode, Name, Latitude, Longitude, Street, Suburb, (
        6371 * acos (
          cos ( radians(:userLatitude) )
          * cos( radians( Latitude ) )
          * cos( radians( Longitude ) - radians(:userLongitude) )
          + sin ( radians(:userLatitude) )
          * sin( radians( Latitude ) )
        )
      ) AS distance
              FROM items
              HAVING distance < :userDistance';
        $query = $pdo->prepare($sql);
        $query->bindParam(':userLatitude', $userLatitude);
        $query->bindParam(':userLongitude', $userLongitude);
        $query->bindParam(':userDistance', $userDistance);
        $query->execute();
        $results = $query->fetchAll();

    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }

    return $results;
}

//gets all the parks containing the string given as part of its name.
function searchParkByName($parkName) {

    global $pdo;

    try {
        $sql = 'SELECT DISTINCT ParkCode, Name, Latitude, Longitude, Street, Suburb
                FROM items
                WHERE Name LIKE CONCAT("%", :name, "%")';
        $query = $pdo->prepare($sql);
        $query->bindParam(':name', $parkName);
        $query->execute();
        $results = $query->fetchAll();


    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }

    return $results;
}

//gets all the parks containing the string given as part of its suburb.
function searchParkBySuburb($suburb) {

    global $pdo;

    try {
        $sql = 'SELECT DISTINCT ParkCode, Name, Latitude, Longitude, Street, Suburb
                FROM items
                WHERE Suburb LIKE CONCAT("%", :suburb, "%")';
        $query = $pdo->prepare($sql);
        $query->bindParam(':suburb', $suburb);
        $query->execute();
        $results = $query->fetchAll();

    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }

    return $results;
}

//gets all parks that have an average rating equal to or greater than the rating value given.
function searchParkByRating($rating) {

    global $pdo;

    try {
        $sql = 'SELECT ParkCode, Name, Latitude, Longitude, Street, Suburb, AvgRating
				FROM (
				SELECT ROUND(Avg(Rating),0) AS AvgRating, ParkCode, Name, Latitude, Longitude, Street, Suburb
				FROM items JOIN reviews
				WHERE items.ID = reviews.ParkID
				GROUP BY ParkCode
				) result
				WHERE AvgRating >= :rating
				ORDER BY AvgRating ASC';

        $query = $pdo->prepare($sql);
        $query->bindParam(':rating', $rating);
        $query->execute();
        $results = $query->fetchAll();

    } catch (PDOException $ex) {
        echo $ex->getMessage();
    }

    return $results;
}

//gets all the parks containing the 1st string given as part of its name and 2nd as part of its suburb.
function searchForParks($parkName, $suburb) {

    global $pdo;

    // Add ratings to the search
    // Join reviews table

    try {
        $sql = 'SELECT DISTINCT ParkCode, Name, Street, Suburb
                FROM items
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

    return $results;
}

//a helper function for rendering the search results from sql queries on a html page.
function outputSearchResults($results) {
    if (!empty($results)) {
        echo '<div class="row">';
        echo '<table>';

        echo '<tr>';
        echo '<th>PARK CODE</th><th>PARK NAME</th><th>STREET</th><th>SUBURB</th>';
        echo '</tr>';

        foreach ($results as $park) {
            echo '<tr>';
            echo "<td>{$park['ParkCode']}</td><td><a href='park.php?ParkCode={$park['ParkCode']}'>{$park['Name']}</a></td><td>{$park['Street']}</td><td>{$park['Suburb']}</td>";
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<h5 class="row center">NO PARKS FOUND...</h5>';
    }
    echo '</div>';


}

//renders the google map results in a new google map widget
function displayMapResults($results) {

    if (!empty($results)) {
        $encodedLocations = json_encode($results);

        echo '<div class = "row">';

        echo '<script>', "var locations = $encodedLocations;", '</script>';

        echo '<div id="results-map"></div>', '<script type="text/javascript">', 'initResultsMap(locations);', '</script>';
    }

    echo '</div>';

}

?>
