<?php
// opens the connection to the database
function OpenCon() {
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "";
  $db = "HappyTech";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
  return $conn;
}

// closes the connection with the database
function CloseCon($conn) {
  $conn -> close();
}
