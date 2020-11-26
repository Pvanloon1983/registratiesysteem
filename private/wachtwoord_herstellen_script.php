<?php

$wachtwoord_reg = 
$wachtwoord_bevestigd_reg = 
$inserted_reg = false;
$_SESSION['wachtwoord_succes_herstel'] = "";

$wachtwoord_reg_err = 
$wachtwoord_bevestigd_reg_err = 
$error_total = "";

if (isset($_POST['wachtwoord']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

  $error_total = 0;

  // Sanitize input
  $wachtwoord_reg = trim(mysqli_real_escape_string($conn, $_POST['wachtwoord']));
  $wachtwoord_bevestigd_reg = trim(mysqli_real_escape_string($conn, $_POST['wachtwoord_bevestigen']));

  // Validate input

  if (empty($wachtwoord_reg)) {
    $wachtwoord_reg_err = "Wachtwoord is verplicht";
    $error_total++;
  } elseif ( strlen($wachtwoord_reg) < 6) {
    $wachtwoord_reg_err = "Het wachtwoord is te kort";
    $error_total++;
  } elseif (empty($wachtwoord_bevestigd_reg)) {
    $wachtwoord_bevestigd_reg_err = "Wachtwoord bevestigen is verplicht";
    $error_total++;
  } elseif ($wachtwoord_reg !== $wachtwoord_bevestigd_reg) {
    $wachtwoord_bevestigd_reg_err = "Beide wachtwoorden kwamen niet overheen";
    $error_total++;
  } else {
    $wachtwoord_reg = password_hash($wachtwoord_reg, PASSWORD_DEFAULT);
  }

  if($error_total === 0){   

      // Update wachtwoord
      $sql = "UPDATE gebruikers SET wachtwoord = ? WHERE herstel_token = ?";

      $stmt = mysqli_prepare($conn, $sql);

      mysqli_stmt_bind_param($stmt, "ss", $wachtwoord_reg, $_SESSION['herstel_token']);

      if(  mysqli_stmt_execute($stmt) ) {

        $wachtwoord_reg = $wachtwoord_bevestigd_reg = "";

        // Delete old token
        $getData = [];
  
        $sql = "SELECT * FROM gebruikers WHERE herstel_token = ?";
      
        $stmt = mysqli_prepare($conn, $sql);
      
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['herstel_token']);
      
        mysqli_stmt_execute($stmt);
      
        $result = mysqli_stmt_get_result($stmt);
        $getData = mysqli_fetch_assoc($result);
      
        if( ! empty( $getData)){
  
     
          $sql = "UPDATE gebruikers SET herstel_token = NULL  WHERE email = ?";
      
          $stmt = mysqli_prepare($conn, $sql);
        
          mysqli_stmt_bind_param($stmt, "s", $getData["email"]);
        
          mysqli_stmt_execute($stmt);
  
          $_SESSION['wachtwoord_succes_herstel'] = "succes";        
      
        }   

      }

  }

}