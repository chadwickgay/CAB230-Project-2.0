<?php

$db_name = 'parksearch';
$db_username = 'parkuser';
$db_password = 'password#77';
$db_host = "localhost";

try {
    $pdo = new PDO ("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


