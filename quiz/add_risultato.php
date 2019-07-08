<?php require_once "config.php";
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
    die;
}?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Aggiungi Risultato</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php
            $id_quiz = intval($_GET['id_quiz']);
        ?>

        <?php include "navbar.php" ?>

        <div class="container">
            <br>
            <div class="row d-flex justify-content-center">
                <div class="col col-md-6 border">
                    <form action="add_risultato_action.php?id_quiz=<?= $id_quiz ?>" method="POST">
                        <div class="form-group">
                            <label for="titolo">Titolo</label>
                            <input class="form-control" type="text" name="titolo" id="titolo">
                        </div>
                        <div class="form-group">
                            <label for="descrizione">Descrizione</label>
                            <input class="form-control" type="text" name="descrizione" id="descrizione">
                        </div>
                        <button class="btn btn-primary" type="submit" name="button">Aggiungi</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
