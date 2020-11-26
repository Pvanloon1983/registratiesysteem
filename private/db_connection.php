<?php
require_once "credentials/database_cred.php";

// DB connection
$dbhost = DBHOST;
$dbuser = DBUSER;
$dbpassword = DBPASSWORD;
$dbname = DBNAME;

$conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if($conn) {
  // echo "Connected successfully";
} else {
  // echo "Connection failed: " . mysqli_connect_error($conn);
}