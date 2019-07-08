<?php
    require_once ("config.php");
?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
     <head>
         <meta charset="utf-8">
         <title>Risultato</title>
         <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     </head>
     <?php
	 
		// conto il numero di risposte per ogni tipo risultato
		// poi li ordino in decrescenza
		// infine visualizzo il risultato con piu' risultati
        $count=array_count_values($_POST);
        arsort($count);
        $keys=array_keys($count);
        $max = $keys[0];

		// estraggo il risultato che ha maggiori risposte associate
        $sql = "SELECT * FROM risultati WHERE id=$max";
        $result = mysqli_query($database, $sql);
     ?>

     <body>
        <?php include "navbar.php" ?>

        <br>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col col-md-6 border">
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <h1><?=$row['titolo']?></h1>
                        <h4><?=$row['descrizione']?></h4>
                    <?php endwhile ?>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
     </body>
 </html>
