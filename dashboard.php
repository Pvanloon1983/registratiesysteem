<?php 
session_start();

require_once "private/db_connection.php";

if (!$_SESSION['gebruiker_ingelogged'] == true) {
  
  header("Location: inloggen.php");
}

if (isset($_POST['uitloggen']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

  // remove all session variables
  session_unset();

  // destroy the session
  session_destroy();

  header("Location: inloggen.php");

}

?>

<?php require_once "includes/header.php"; ?>

  <title>Registratiesysteem | Dashboard</title>
</head>
<body>

<div class="container">

  <h1>Welkom bij het Dashboard!</h1>

  <p>Gebruiker: <?= $_SESSION['gebruikersnaam']; ?></p>

  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <button class="btn btn-info" name="uitloggen">Uitloggen</button>
  </form>

</div>

<?php require_once "includes/footer.php"; ?>