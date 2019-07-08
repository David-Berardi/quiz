<?php require_once "config.php";
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
            $id = $_GET['id']; // prendo l'ID dall'url del quiz specifico che sto visualizzando
			
			// la query di selezione delle domande del quiz specifico
            $sql = "SELECT * FROM domande WHERE id_quiz=$id";
            $result = mysqli_query($database, $sql);
        ?>

        <?php include "navbar.php" ?>

        <div class="container">
            <br>
            <div class="row d-flex justify-content-center">
                <div class="col col-md-6 border">
				
					<!-- Se l'utente, di conseguenza e' admin, e' loggato allora permetto di aggiungere domande al quiz-->
                    <?php if(isset($_SESSION['username'])): ?>
                        <h2>Aggiungi Domande</h2>
                        <form action="add_domanda.php" method="POST">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <div class="form-group">
                                <label for="descrizione">Domanda</label>
                                <input class="form-control" type="text" name="descrizione" id="descrizione">
                            </div>
                            <button class="btn btn-primary" type="submit" name="button">Aggiungi</button>
                        </form>
                    <?php endif ?>
					
					<!-- visualizzo il titolo del quiz, se presente nell'url -->
                    <?php if(isset($_GET['titolo'])): ?>
                        <h2><?= $_GET['titolo'] ?></h2>
                    <?php else: ?>
                        <h2>Quiz</h2>
                    <?php endif ?>
					
					
                    <form action="risultato.php" method="POST">
					
						<!-- visualizzo tutte le domande, con rispettive risposte -->
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <div class="media border">
                                <div class="media-body">
									<!-- visualizza domanda -->
                                    <h5 class="mt-0"><?= $row['descrizione']?></h5>
                                    <?php if(isset($_SESSION['username'])): ?>
                                        <p class="align-right">
                                            <a class="btn btn-warning" href="add_risposta.php?id=<?= $row['id'] ?>&id_quiz=<?= $id ?>">Aggiungi Risposta</a>
                                            <a class="btn btn-danger" href="delete_domanda.php?id=<?= $row['id'] ?>&id_quiz=<?= $id ?>">Elimina Domanda</a>
                                        </p>
                                    <?php endif ?>

                                    <?php
                                        $id_domanda = $row['id']; // prendo l'id della domanda corrente
                                        $sql2 = "SELECT * FROM risposte WHERE id_domanda=$id_domanda"; // estraggo tutte le risposte relative alla domanda specifica
                                        $result2 = mysqli_query($database, $sql2); // eseguo la query
                                    ?>
									<!-- visualizzo le risposte correlate -->
                                    <?php while($row2 = mysqli_fetch_assoc($result2)): ?>
										<!-- se sono loggato allora permetto di eleminare la risposta -->
                                        <?php if(isset($_SESSION['username'])): ?>
                                            <div class="media mt-3">
                                                <img src="" class="mr-3">
                                                <div class="media-body">
                                                    <h5 class="mt-0">Risposta</h5>
                                                    <p>
                                                        <?= $row2['contenuto'] ?>
                                                        <a class="btn btn-danger float-right" href="delete_risposta.php?id=<?= $row2['id'] ?>&id_quiz=<?= $id ?>">Elimina</a>
                                                    </p>
                                                </div>
                                            </div>
											
										<!-- altrimenti permetto all'utente di rispondere alla domanda -->
                                        <?php else: ?>
                                            <div class="media mt-3">
                                                <img src="" class="mr-3">
                                                <div class="media-body">
                                                    <div class="form-check">
                                                          <input class="form-check-input" type="radio" name="<?= $id_domanda ?>" value="<?= $row2['id_risultato'] ?>">
                                                          <label class="form-check-label">
                                                              <?= $row2['contenuto'] ?>
                                                          </label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                    <?php endwhile ?>
                                </div>
                            </div>
                            <br>
                        <?php endwhile ?>
						
						<!-- se NON sei loggato allora puoi vedere il risultato del quiz -->
                        <?php if(!isset($_SESSION['username'])): ?>
                            <button type="submit">Risultato</button>
                        <?php endif ?>

                        <?php
                            $sql3 = "SELECT * FROM risultati WHERE id_quiz=$id"; // estraggo tutti i risultati possibili del quiz specifico
                            $result3 = mysqli_query($database, $sql3);
                        ?>
						
						<!-- se sei loggato, visualizza tutti i risultati con corrispondente creazione ed eliminazione -->
                        <?php if(isset($_SESSION['username'])): ?>
                                <div class="media border">
                                    <div class="media-body">
                                        <h5 class="mt-0">Risultato</h5>
                                        <p class="align-right">
                                            <a class="btn btn-warning" href="add_risultato.php?id_quiz=<?= $id ?>">Aggiungi Risultato</a>
                                        </p>

										<!-- elenco dei risultati -->
                                        <?php while($row3 = mysqli_fetch_assoc($result3)): ?>
                                            <div class="media mt-3">
                                                <img src="" class="mr-3">
                                                <div class="media-body">
                                                    <h5 class="mt-0">Risultato</h5>
                                                    <p>
                                                        <?= $row3['titolo'] ?>
                                                        <a class="btn btn-danger float-right" href="delete_risultato.php?id=<?= $row3['id'] ?>&id_quiz=<?= $id ?>">Elimina</a>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php endwhile ?>
                                    </div>
                                </div>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
