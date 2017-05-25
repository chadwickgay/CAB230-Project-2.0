<?php

  include 'config.php';
  try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sth = $db->query("SELECT * FROM parksearch.parks");
    $results = $sth->fetchAll();
    echo json_encode($results);
  } catch (Exception $e) {
    echo $e->getMessage();
  }
