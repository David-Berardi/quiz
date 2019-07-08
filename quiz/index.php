<?php
require_once "config.php";

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Quiz</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <?php
		// * paginazione 
        $max_quiz = 5;
        $pag = intval($_GET['pag'] ?? 0);
        $offset = ($pag * $max_quiz);

		// query di estrazione dei post
        $query = "SELECT * FROM quiz";

		// ricerca per titolo: estrapolo dall'url tramite la richiesta GET ciò che voglio cercare
        $search = mysqli_real_escape_string($database, $_GET['search'] ?? null);

		// controllo se c'è qualcosa da cercare, se è così allora espando
		// la query cercando sul database il quiz che ha per titolo qualcosa che assomiglia alla ricerca
        if ($search) {
          $query .= " WHERE titolo LIKE '%$search%'";
        }

		// *
        $query .= " LIMIT $offset, $max_quiz";

		// la query effettiva sul database
        $result = mysqli_query($database, $query);

		// *
        $result2 = mysqli_query($database, "SELECT FOUND_ROWS()");
        $max_pag = mysqli_fetch_assoc($result2)['FOUND_ROWS()'] / $max_quiz;
    ?>
    <?php include "navbar.php" ?>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col col-md-10">
                <h1>Tutti i Quiz</h1>

				<!-- barra di ricerca -->
                <form action="index.php" method="GET">
                  <input type="text" name="search" placeholder="Cerca per titolo">
                  <button type="submit">Cerca</button>
                </form>

                <br>

				<!-- elenco dei quiz con i vari dati: titolo, descrizione, data creazione-->
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <div class="card">
                        <h5 class="card-header"><a href="quiz.php?id=<?= $row['id']?>&titolo=<?= $row['titolo']?>"><?= $row['titolo']?></a></h5>
                        <div class="card-body">
                            <p class="card-text"><?= $row['descrizione']?></p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text">
                                Data Creazione: <?= $row['data_creazione'] ?>
								
								<!-- Se l'utente è loggato allora è permessa la modifica del quiz: eliminazione, modifica -->
                                <?php if(isset($_SESSION['username'])): ?>
                                    <a class="btn btn-danger float-right" href="delete_quiz.php?id=<?= $row['id'] ?>">Elimina</a>
                                    <a class="btn btn-warning float-right" href="modify_quiz.php?id=<?= $row['id'] ?>">Modifica</a>
                                <?php endif ?>
                            </p>
                        </div>
                    </div>
                    <br>
                <?php endwhile ?>
            </div>
        </div>
		
	    <!-- paginazione -->
        <div class="row d-flex justify-content-center">
            <ul class="pagination">
              <?php for ($i = 0; $i <= $max_pag; $i++): ?>
                <?php if($i != $pag): ?>
                    <li class="page-item"><a class="page-link" href="index.php?pag=<?=$i?>"><?=$i+1?></a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link"><?=$i+1?></a></li>
                <?php endif ?>
              <?php endfor ?>
            </ul>
        </div>
    </div>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
