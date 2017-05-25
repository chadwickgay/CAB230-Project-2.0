<?php

  include 'config.php';
  try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $sth = $db->query("SELECT * FROM parks");
    $youapp = $sth->fetchAll();
    echo json_encode( $youapp );
  } catch (Exception $e) {
    echo $e->getMessage();
  }
