<?php

if ((isset($_GET['herstel_token']) && $_SERVER['REQUEST_METHOD'] === 'GET') ||
    (isset($_POST['wachtwoord']) && $_SERVER['REQUEST_METHOD'] === 'POST')) {

  $_SESSION['herstel_token'] = $_GET['herstel_token'];

  $getData = [];

  // Check if email token exists
  $sql = "SELECT * FROM gebruikers WHERE herstel_token = ?";

  $stmt = mysqli_prepare($conn, $sql);

  mysqli_stmt_bind_param($stmt, "s", $_SESSION['herstel_token']);

  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $getData = mysqli_fetch_assoc($result);

  if( ! empty( $getData)){

    // echo "Token is bekend";

 } else {

   header("Location: inloggen.php");

  }

} else {

  header("Location: inloggen.php");

}