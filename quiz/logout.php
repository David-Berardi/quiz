<?php
session_start();

// distruggo la sessione e rendirizzo alla pagina principale
if (session_destroy()) {
    header("location: index.php");
    die();
}
