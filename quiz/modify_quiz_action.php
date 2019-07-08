<?php
  require_once "config.php";
  if(!isset($_SESSION['username'])) {
      header("Location: index.php");
      die;
  }}

  $id = intval($_POST['id']);
  $titolo = mysqli_real_escape_string($database, $_POST['titolo'] ?? '');
  $descrizione = mysqli_real_escape_string($database, $_POST['descrizione'] ?? '');

  if(isset($_POST['submit'])) {
      $query = "UPDATE quiz SET titolo='$titolo', descrizione='$descrizione' WHERE id=$id";
      $result = mysqli_query($database, $query);
  } else {
      die();
  }

  header("Location: index.php");
?>
