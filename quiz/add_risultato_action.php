<?php
    require_once "config.php";
    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        die;
    }

    $id_quiz = intval($_GET['id_quiz']);

    $titolo = mysqli_real_escape_string($database, $_POST['titolo'] ?? '');
    $descrizione = mysqli_real_escape_string($database, $_POST['descrizione'] ?? '');

    $sql = "INSERT INTO risultati VALUES(NULL, '$titolo', '$descrizione', $id_quiz)";
    $result = mysqli_query($database, $sql);

    header("Location: quiz.php?id=$id_quiz");
?>
