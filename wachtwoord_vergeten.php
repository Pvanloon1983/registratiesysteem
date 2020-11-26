<?php 
session_start();

require_once "private/db_connection.php";
require_once "private/wwvergeten_script.php";

?>

<?php require_once "includes/header.php"; ?>

  <title>Registratiesysteem | Wachtwoord vergeten</title>
</head>

<body class="body-wwvergeten">

  <div class="container-wwvergeten container">

    <h1 class="title-wwvergeten-page">Wachtwoord vergeten</h1>

    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="wwvergeten-form">

    <?php if ($succes_message_email) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div>U ontvangt zodadelijk een email met daarin instructies om uw wachtwoord te herstellen!</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php elseif ($error_message_email) : ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div>Er is iets misgegaan met het versturen van de email. Neem contact op met de uw webadmin.</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php endif; ?>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control  mb-1" name="email" id="email" 
        value="<?php echo htmlspecialchars((!empty($email_wwvergeten)) ? $email_wwvergeten : ""); ?>">
        <span
          class="error_input"><?php echo htmlspecialchars((!empty($email_wwvergeten_err)) ? $email_wwvergeten_err : "");  ?></span>
      </div>
      <button class="btn btn-light btn-block" id="btn-wwvergeten" name="submit-wwvergeten">Verzenden
          <span class="loader" id="loader"><img src="./svg-loaders/tail-spin.svg" alt=""></span>
      </button>

      <p class="al-ingelogd-p text-center">Wachtwoord niet vergeten? <a class="link-wwherstellen" href="inloggen.php"> Inloggen</a></p>

    </form>

  </div>

<?php require_once "includes/footer.php"; ?>