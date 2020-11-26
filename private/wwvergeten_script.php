<?php
$email_wwvergeten = 
$succes_message_email = false;
$error_message_email = false;

$email_wwvergeten_err = 
$error_total = "";

if (isset($_POST['email']) && $_SERVER['REQUEST_METHOD'] === 'POST') {    

  $error_total = 0;

  // Sanitize input
  $email_wwvergeten = trim(mysqli_real_escape_string($conn, $_POST['email']));

  if (empty($email_wwvergeten)) {
    $email_wwvergeten_err = "E-mail is verplicht";
    $error_total++;
    $loader = false;
  } elseif (!filter_var($email_wwvergeten, FILTER_VALIDATE_EMAIL)) {
    $email_wwvergeten_err = "Dit e-mailadres is niet geldig";
    $error_total++;
    $loader = false;
  }

  // https://www.vdsz.nl/php_mysql/mysqli_stmt_prepared_statements

  // https://www.wdb24.com/php-mysqli-procedural-prepared-statements-beginners/

  if($error_total === 0){       

      $getData = [];

      // Check first if email adres exists
      $sql = "SELECT * FROM gebruikers WHERE email = ?";

      $stmt = mysqli_prepare($conn, $sql);

      mysqli_stmt_bind_param($stmt, "s", $email_wwvergeten);

      mysqli_stmt_execute($stmt);
  
      $result = mysqli_stmt_get_result($stmt);
      $getData = mysqli_fetch_assoc($result);

      if( empty( $getData)){

        $email_wwvergeten_err = "Dit e-mailadres is niet geregistreerd";
        $loader = false;

      } else {       
        

        $herstel_token = bin2hex(random_bytes(30));
        
        $sql = "UPDATE gebruikers SET herstel_token = ? WHERE email = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "ss", $herstel_token, $email_wwvergeten);
  
        mysqli_stmt_execute($stmt);

        /****** SEND EMAIL WITH TOKEN */

        require_once "email_config.php";

    }

  }

}
