<?php 
session_start();


require_once "private/db_connection.php";
require_once "private/inloggen_script.php";

?>

<?php require_once "includes/header.php"; ?>

  <title>Registratiesysteem | Inloggen</title>
</head>

<body class="body-inlog">

  <div class="container-inlog container">

    <h1 class="title-inlog-page">Inloggen</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="inlog-form">

      <?php if (isset($_SESSION['wachtwoord_succes_herstel']) && $_SESSION['wachtwoord_succes_herstel'] == "succes") : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <div>Uw wachtwoord is succesvol hersteld. U kunt nu inloggen.</div>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php
      
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
      
      ?>
      <?php endif; ?>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control  mb-1" name="email" id="email" 
        value="<?php echo htmlspecialchars((!empty($email_inlog)) ? $email_inlog : ""); ?>">
        <span
          class="error_input"><?php echo htmlspecialchars((!empty($email_inlog_err)) ? $email_inlog_err : "");  ?></span>
      </div>
      <div class="form-group">
        <label for="wachtwoord" class="wachtwoord-label-text">Wachtwoord</label>
        <input type="password" class="form-control  mb-1" name="wachtwoord" id="wachtwoord" 
        value="">
        <span
          class="error_input"><?php echo htmlspecialchars((!empty($wachtwoord_inlog_err)) ? $wachtwoord_inlog_err : "");  ?></span>
      </div>

      <div class="wachtwoord-vergeten-link"><a href="wachtwoord_vergeten.php">Wachtwoord vergeten</a> <label class="float-right label-wwzien" for="wwzien"><input id="wwzien" type="checkbox" onclick="wachtwoordZien()"> Wachtwoord zien</label></div>

      <button class="btn btn-light btn-block" id="btn-inloggen" name="submit-inlog">Inloggen</button>

    </form>

    <p class="al-geregistreerd-p">Nog niet geregistreerd? <a class="link-inloggen" href="registreren.php"> Registreren</a></p>

  </div>

  <script>
    function wachtwoordZien() {
    var x = document.getElementById("wachtwoord");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  </script>

<?php require_once "includes/footer.php"; ?>