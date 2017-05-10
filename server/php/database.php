<?php

$db_name = 'parksearch';
$db_username = 'parkuser';
$db_password = 'password';
$db_host = "localhost";

try {
    $pdo = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e) {
    echo $e->getMessage();
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

function showAllParks(){
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
?>
