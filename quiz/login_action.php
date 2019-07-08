<?php
require_once "config.php";

// prendo dal POST le credenziali
$username = mysqli_real_escape_string($database, $_POST['username'] ?? '');
$password = mysqli_real_escape_string($database, $_POST['password'] ?? '');

// estraggo tutti gli utenti dal database con quelle credenziali
$sql = "SELECT * FROM utenti WHERE username='$username' AND password='$password'";
$rs = mysqli_query($database, $sql);

// conto quanti utenti risultano
$count = mysqli_num_rows($rs);

// se ne risulta solo uno allora le credenziali sono corrette
// ed imposto nella sessione l'utente e reindirizzo alla pagina principale.
if ($count == 1) {
    $_SESSION['username'] = $username;
    unset($_SESSION['login_error']);
    header("location: index.php");
} 
// altrimenti do un messaggio di errore e reindirizzo alla pagina di login
else {
    $_SESSION['login_error'] = "username o password incorrette";
    header("location: login.php");
    die();
}
