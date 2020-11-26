<?php

$naam_reg = 
$email_reg = 
$wachtwoord_reg = 
$wachtwoord_bevestigd_reg = 
$inserted_reg = false;

$naam_reg_err = 
$email_reg_err = 
$wachtwoord_reg_err = 
$wachtwoord_bevestigd_reg_err = 
$error_total = "";

if (isset($_POST['naam']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

  $error_total = 0;

  // Sanitize input
  $naam_reg = trim(mysqli_real_escape_string($conn, $_POST['naam']));
  $email_reg = trim(mysqli_real_escape_string($conn, $_POST['email']));
  $wachtwoord_reg = trim(mysqli_real_escape_string($conn, $_POST['wachtwoord']));
  $wachtwoord_bevestigd_reg = trim(mysqli_real_escape_string($conn, $_POST['wachtwoord_bevestigen']));

  // Validate input
  if (empty($naam_reg)) {
    $naam_reg_err = "Naam is verplicht";
    $error_total++;
  }

  if (empty($email_reg)) {
    $email_reg_err = "E-mail is verplicht";
    $error_total++;
  } elseif (!filter_var($email_reg, FILTER_VALIDATE_EMAIL)) {
    $email_reg_err = "Dit e-mailadres is niet geldig";
    $error_total++;
  }

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

    $getData = [];

    // Check if email adres exists
    $sql = "SELECT * FROM gebruikers WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $email_reg);

    mysqli_stmt_execute($stmt);
 
    $result = mysqli_stmt_get_result($stmt);
    $getData = mysqli_fetch_assoc($result);

    if( ! empty( $getData)){

      $email_reg_err = "Dit e-mailadres is al geregistreerd";

    } else {

      // Voeg nieuwe gebruiker toe wanneer email nog niet is geregistreerd
      $sql = "INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord) VALUES (?, ?, ?)";

      $stmt = mysqli_prepare($conn, $sql);

      mysqli_stmt_bind_param($stmt, "sss", $naam_reg, $email_reg, $wachtwoord_reg);

      if (mysqli_stmt_execute($stmt)) {

        $naam_reg = $email_reg = $wachtwoord_reg = $wachtwoord_bevestigd_reg = "";

        $inserted_reg = true;

      }   


    }

  }

}