<?php
    require_once "config.php";
    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        die;
    }

    $id_domanda = intval($_GET['id']);
    $id_quiz = intval($_GET['id_quiz']);

    $contenuto = mysqli_real_escape_string($database, $_POST['contenuto'] ?? '');
    $id_risultato = intval($_POST['risultati']);

    $sql = "INSERT INTO risposte VALUES(NULL, '$contenuto', $id_domanda, $id_risultato)";
    $result = mysqli_query($database, $sql);

    header("Location: quiz.php?id=$id_quiz");
?>
