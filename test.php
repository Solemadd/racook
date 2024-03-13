<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Racook - Connexion</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>

<?php

$db = new PDO("mysql:host=localhost;dbname=racook;charset=utf8mb4", "root", "");

$data = $db->query("SELECT * 
                    FROM recette
                    ")->fetchALL();

$data_recette_ingredient = $db->query("SELECT * FROM ingredient
                                                INNER JOIN recette_ingredient
                                                ON ingredient.ID = recette_ingredient.ID_ingredient
                                                                              ")->fetchALL();

$data_commentaire = $db->query("SELECT * FROM commentaire
                                 INNER JOIN recette
                                 ON commentaire.ID_recette = recette.ID")->fetchAll();


foreach ($data as $row) {
  echo '
  <section class="fiches2 container-fluid">
  <div class="col-md-4">
  <div class="card text-center" style="width: 22em;">
  <img class="card-img-top" src="'.$row['url_recette'].'" alt="Card image cap">
  <div class="card-body">
    <p class="card-text"><h2>Nom de la recette : </h2></p>
    <h3><b>'.$row['nom_recette'].'</b></h3>
    <br>
    <h5>etape:</h5>
      <p>'.$row['etape'].'<p>
    
    <h5>Temps de préparation:</h5>
      <p>'.$row['temps_preparation'].'min<p>
    
    <h5>Temps de cuisson :</h5>
    <p>'.$row['temps_cuisson'].'min</p>
    
    <h5>Difficulté :</h5>
    <p>'.$row['difficulte'].'/5</p>
    
    <h5>Ingrédients :</h5>';

    foreach ($data_recette_ingredient as $row_ingredient){
    if ($row['ID'] === $row_ingredient['ID_recette']) {
      echo '
      '.$row_ingredient['quantite'].''.$row_ingredient['unite'].' '.$row_ingredient['nom_ingredient'].'
      ';
    }
    };

    foreach ($data_commentaire as $row_commentaire){
      if ($row['ID'] === $row_commentaire['ID_recette']) {
        echo '
        <br>
        Commentaire :
        <h5>'.$row_commentaire['titre_com'].'</h5>
        '.$row_commentaire['contenu_com'].' 
        '.$row_commentaire['ID_utilisateur'].',
        ';
      }
      }

  '</div>
</div>
</div>
</section>';
}
  ?>




  </body>
  <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
</html>
