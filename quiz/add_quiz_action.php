<?php
  require_once "config.php";
  if(!isset($_SESSION['username'])) {
      header("Location: index.php");
      die;
  }

  header("Location: index.php");

  $titolo = mysqli_real_escape_string($database, $_POST['titolo'] ?? '');
  $descrizione = mysqli_real_escape_string($database, $_POST['descrizione'] ?? '');

  if(isset($_POST['submit'])) {
      $query = "INSERT INTO quiz VALUES (NULL, '$titolo', '$descrizione', CURRENT_TIMESTAMP())";
      $result = mysqli_query($database, $query);
  } else {
      die();
  }
?>
