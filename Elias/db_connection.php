<?php
//  This function written by Taisiya

function OpenCon() {
  $dbhost = "localhost";
  $dbuser = "root";
  $dbpass = "root";
  $db = "HappyTech";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

  return $conn;
}


function CloseCon($conn) {
  $conn -> close();
}

?>