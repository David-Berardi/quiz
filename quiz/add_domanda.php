<?php
    require_once "config.php";
	// controllo sempre che io non sia anonimo, in tal caso, impedisco azioni da admin
    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        die;
    }

    $id_quiz = intval($_POST['id']); // ID del quiz in modo tale da potersi reindirizzare verso quel quiz
    $descrizione = mysqli_real_escape_string($database, $_POST['descrizione'] ?? '');

    $sql = "INSERT INTO domande VALUES (NULL, '$descrizione', $id_quiz)";
    $result = mysqli_query($database, $sql);

    header("Location: quiz.php?id=$id_quiz"); // reindirizzo l'utente al quiz di provenienza
?>
