<!doctype html>
<html lang="en" class="light_body">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Racook</title>
  </head>

  <nav class="downbar">
      <a href="manage.php"><img src="img/navbarplus.png" alt=""></a>
      <a href="main.php"><img src="img/navbarhome.png" alt=""></a>
      <a href="profile.php"><img src="img/navbarprofile.png" alt=""></a>
  </nav>


  <?php

$db = new PDO("mysql:host=localhost;dbname=racook;charset=utf8mb4", "root", "");

$data = $db->query("SELECT * 
                    FROM recette
                    ")->fetchALL();

$data_recette_ingredient = $db->query("SELECT * FROM ingredient
                                                INNER JOIN recette_ingredient
                                                ON ingredient.ID = recette_ingredient.ID_ingredient
                                                                              ")->fetchALL();

foreach ($data as $row) {
  echo '


  <main class="affichage">
    <div>
      <img src="'.$row['url_recette'].'" alt="image de petites tartes à la carotte">
    </div>
    <article>
        <div>
        <h5 class="margin5">'.$row['nom_recette'].'</h5>
        <h6>Temps de préparation:</h6>
            <p>'.$row['temps_preparation'].'min<p>
        <h6>Difficulté :</h6>
            <p>'.$row['difficulte'].'/5</p>
        <h6>Ingrédients:</h6>
        ';
          foreach ($data_recette_ingredient as $row_ingredient){
            if ($row['ID'] === $row_ingredient['ID_recette']) {
              echo '
              '.$row_ingredient['quantite'].''.$row_ingredient['unite'].' '.$row_ingredient['nom_ingredient'].'
              ';
            }
            };'
      <h6>Cuisson:</h6>
          <p>'.$row['temps_cuisson'].'min</p>
      <h6>Etapes:</h6>
          <p>'.$row['etape'].'</p>
      </div>
    </article>
</main>';
}
  ?>


<main class="newrecipe">
    <hr class="primary width100">
  <h5>Publier un commentaire:</h5>
      <form action="" style="margin-top: 5%;">
        <input type="text" name="titre" placeholder="Titre:">
        <h1></h1>
        <textarea name="commentaire" id="" cols="30" rows="6" placeholder="Comentaire:"></textarea>
        <input type="submit" style="margin-top: 5%;">
      </form>


    
      <?php
  if (isset($_POST["titre"]) && isset($_POST["commentaire"])){
  $titre = $_POST["titre"];
  $commentaire = $_POST["commentaire"];
  $user = $_SESSION['id'];


  $db = new PDO("mysql:host=localhost;dbname=racook;charset=utf8mb4", "root", "");

  $stmt = $db->prepare("INSERT INTO commentaire (titre_com, contenu_com, ID_utilisateur) VALUES (:titre_com, :contenu_com, :ID_utilisateur)");
  $stmt->bindParam(":titre_com", $titre);
  $stmt->bindParam(":contenu_com", $commentaire);
  $stmt->bindParam(":ID_utilisateur", $user);

  $stmt->execute();

  
  echo '<div>
  <strong>C est nickel</strong> l\'ajout est OK.
  </div>';
}

    ?>






<?php

$db = new PDO("mysql:host=localhost;dbname=racook;charset=utf8mb4", "root", "");

$data_commentaire = $db->query("SELECT * FROM commentaire
                                 INNER JOIN recette
                                 ON commentaire.ID_recette = recette.ID")->fetchAll();

foreach ($data as $row) {
    foreach ($data_commentaire as $row_commentaire){
      if ($row['ID'] === $row_commentaire['ID_recette']) {
        echo '
        <h4>Commentaires:</h4>
        <br>
        <section class="carte">
        <h5>'.$row_commentaire['titre_com'].'</h5>
        <h6>Utilisateur: '.$row_commentaire['ID_utilisateur'].'</h6>
        <p>'.$row_commentaire['contenu_com'].'</p></section>
        ';
      }
      }
;
}
  ?>
</main>



</html>