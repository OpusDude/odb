<?php
  $serverName = "localhost";
  $username   = "root";
  $password   = "sbAXBP9*qdyE";
  $dbname     = "ODB_DB";

  $conn = mysqli_connect($serverName, $username, $password, $dbname);
  if( $conn->connect_error ) {
     echo "Connection could not be established.<br/>";
     die($conn->connect_error);
  }
?>