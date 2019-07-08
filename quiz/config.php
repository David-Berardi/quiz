<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1);

// instauro la connessione col database, con le credenziali del db
$database = mysqli_connect("localhost","root","","quiz");
if (!$database) {
  echo mysqli_connect_error();
  die;
}
?>
