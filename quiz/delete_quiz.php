<?php
    require_once "config.php";
    if(!isset($_SESSION['username'])) {
        header("Location: index.php");
        die;
    }

    $id = intval($_GET['id']);

    $sql = "DELETE FROM quiz WHERE id=$id";
    $result = mysqli_query($database, $sql);

    header("Location: index.php");
?>
