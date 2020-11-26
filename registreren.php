<?php 

require_once "private/db_connection.php";
require_once "private/registreren_script.php";

?>

<?php require_once "includes/header.php"; ?>

  <title>Registratiesysteem | Registreren</title>
</head>

<body class="body-reg">

  <div class="container-reg container">

    <h1 class="title-reg-page">Registreren</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="reg-form">

      <div class="form-group">
        <label for="naam">Gebruikersnaam</label>
        <input type="text" class="form-control mb-1" name="naam" id="naam" 
        value="<?php echo htmlspecialchars((!empty($naam_reg)) ? $naam_reg : ""); ?>">
        <span class="error_input"><?php echo htmlspecialchars((!empty($naam_reg_err)) ? $naam_reg_err : "");  ?></span>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control  mb-1" name="email" id="email" 
        value="<?php echo htmlspecialchars((!empty($email_reg)) ? $email_reg : ""); ?>">
        <span
          class="error_input"><?php echo htmlspecialchars((!empty($email_reg_err)) ? $email_reg_err : "");  ?></span>
      </div>
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

      <button class="btn btn-light btn-block" id="btn-registreren" name="submit-reg">Registreren</button>     

    </form>

    <p class="al-ingelogd-p">Al geregistreerd? <a class="link-registreren" href="inloggen.php"> Inloggen</a></p>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <?php if($inserted_reg == true) : ?>
    <script>

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })

      Toast.fire({
        icon: 'success',
        title: 'U bent succesvol registreerd. U kunt nu inloggen!'
      })

    </script>  
  <?php endif; ?>

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