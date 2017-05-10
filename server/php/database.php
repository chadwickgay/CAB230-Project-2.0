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

?>