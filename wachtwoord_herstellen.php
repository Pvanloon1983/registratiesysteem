<?php 
session_start();

require_once "private/db_connection.php";
require_once "private/wachtwoord_herstellen_script.php";
require_once "private/check_token_script.php";

?>

<?php require_once "includes/header.php"; ?>

  <title>Registratiesysteem | Wachtwoord herstellen</title>
</head>

<body class="body-wwherstellen">

  <div class="container-wwherstellen container">

    <h1 class="title-wwherstellen-page">Wachtwoord herstellen</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?herstel_token=" . $_SESSION['herstel_token'];?>" method="post" id="wwherstellen-form">

      <div class="form-group">
        <label for="wachtwoord" class="wachtwoord-label-text">Wachtwoord <sup class="text-right">* Tenminste 6 tekens</sup></label>
        <input type="password" class="form-control  mb-1" name="wachtwoord" id="wachtwoord" 
        value="">
        <span
          class="error_input"><?php echo htmlspecialchars((!empty($wachtwoord_reg_err)) ? $wachtwoord_reg_err : "");  ?></span>
      </div>
      <div class="form-group">
        <label for="wachtwoord_bevestigen">Wachtwoord bevestigen</label>
        <input type="password" class="form-control  mb-1" name="wachtwoord_bevestigen" id="wachtwoord_bevestigen"
          value="">
        <span
          class="error_input"><?php echo htmlspecialchars((!empty($wachtwoord_bevestigd_reg_err)) ? $wachtwoord_bevestigd_reg_err : "");  ?></span>
      </div>

      <label class="float-right label-wwzien" for="wwzien"><input id="wwzien" type="checkbox" onclick="wachtwoordZien()"> Wachtwoord zien</label>

      <button class="btn btn-light btn-block" id="btn-wwherstellen" name="wwherstellen-reg">Herstel wachtwoord</button>     

    </form>

    <p class="al-ingelogd-p">Wachtwoord hersteld? <a class="link-wwherstellen" href="inloggen.php"> Inloggen</a></p>

  </div>

  <script>
    function wachtwoordZien() {
    var x = document.getElementById("wachtwoord");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }

    var x = document.getElementById("wachtwoord_bevestigen");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  </script>

<?php require_once "includes/footer.php"; ?>