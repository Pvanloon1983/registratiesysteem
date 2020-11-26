<?php
$naam_inlog = 
$email_inlog = 
$wachtwoord_inlog = 
$wachtwoord_bevestigd_inlog = 
$inserted_inlog = false;

$naam_inlog_err = 
$email_inlog_err = 
$wachtwoord_inlog_err = 
$wachtwoord_bevestigd_inlog_err = 
$error_total = "";

if (isset($_POST['email']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

  $error_total = 0;

  // Sanitize input
  $email_inlog = trim(mysqli_real_escape_string($conn, $_POST['email']));
  $wachtwoord_inlog = trim(mysqli_real_escape_string($conn, $_POST['wachtwoord']));

  if (empty($email_inlog)) {
    $email_inlog_err = "E-mail is verplicht";
    $error_total++;
  } elseif (!filter_var($email_inlog, FILTER_VALIDATE_EMAIL)) {
    $email_inlog_err = "Dit e-mailadres is niet geldig";
    $error_total++;
  }

  if (empty($wachtwoord_inlog)) {
    $wachtwoord_inlog_err = "Wachtwoord is verplicht";
    $error_total++;
  }

  // https://www.vdsz.nl/php_mysql/mysqli_stmt_prepared_statements

  // https://www.wdb24.com/php-mysqli-procedural-prepared-statements-beginners/

  if($error_total === 0){   

      $getData = [];

      // Check first if email adres exists
      $sql = "SELECT * FROM gebruikers WHERE email = ?";

      $stmt = mysqli_prepare($conn, $sql);

      mysqli_stmt_bind_param($stmt, "s", $email_inlog);

      mysqli_stmt_execute($stmt);
  
      $result = mysqli_stmt_get_result($stmt);
      $getData = mysqli_fetch_assoc($result);

      if( empty( $getData)){

        $email_inlog_err = "Dit e-mailadres is niet geregistreerd";

      } else {    

      // Check first if email adres exists
      $sql = "SELECT * FROM gebruikers WHERE email = ?";

      $stmt = mysqli_prepare($conn, $sql);

      mysqli_stmt_bind_param($stmt, "s", $email_inlog);

      mysqli_stmt_execute($stmt);
  
      $result = mysqli_stmt_get_result($stmt);
      $getData = mysqli_fetch_assoc($result);

      $wachtwoord_inlog = password_verify($wachtwoord_inlog, $getData['wachtwoord']);  

      if ($wachtwoord_inlog) {
        
        $_SESSION['gebruikersnaam'] = $getData['gebruikersnaam'];
        $_SESSION['email'] = $getData['email'];
        $_SESSION['gebruiker_ingelogged'] = true;

        header("Location: dashboard.php");

      } else {

        $wachtwoord_inlog_err = "Wachtwoord is onjuist";    
      
      }

    }

  }

}
