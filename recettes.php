<?php session_start(); ?>
<!doctype html>
<html lang="en" class="light_body">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Racook</title>
  </head>

  <script> 
  //id de la catégorie à cacher:filtres
  //id du boutton qui effectue cette action:filter
  //lorsque j'appuie sur le boutton filtre, la classe hidden de l'element doit disparaitre
  //lorsque j'appuie sur valider, la classe reviens, et l'element est caché à nouveau.
  



  //PAS TOUCHE A LA SUITE

  
  // Get the button:
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
} 
  </script>
  


  <footer>
    <button id="topBTN" onclick="topFunction()">↑</button>
    
  </footer>

 
  <main>
     <a href="profile.php"><img src="img/back.png" class="retour" alt="Retour"></a> <br class="margin10">
    <h3>Mes recettes:</h3>
    
    

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

$data_like = $db->query("SELECT * 
                    FROM aime 
                    
                    ")->fetchALL();

foreach ($data_like as $row_like){
  if ($row_like['ID_utilisateur'] == $_SESSION['id']){
foreach ($data as $row) { if ($row_like['ID_recette'] == $row['ID']){
    echo '<section class="carte" style="margin-top:5%">
    
            <article style="width:60%;">
                <div>
                <h5 class="margin5">'.$row['nom_recette'].'</h5>
                <h6>Ingrédients:</h6>';
    foreach ($data_recette_ingredient as $row_ingredient) {
        if ($row['ID'] === $row_ingredient['ID_recette']) {
            echo '<p>'.$row_ingredient['quantite'].''.$row_ingredient['unite'].' '.$row_ingredient['nom_ingredient'].'</p>';
        }
    }
    echo '<h6>Cuisson:</h6>
          <p>'.$row['temps_cuisson'].'min</p>
          </div>
          </article>
          <div>
          <img src="'.$row['url_recette'].'" alt="image de '.$row['nom_recette'].'">
          </div>
          <button onclick="window.location = \'affichage.php?id='.$row["ID"].'\'">Voir la recette</button>
          </section>';
}}}}
?>



<br style="margin-top:300px">


  </main>

  <nav class="downbar">
    <a href="manage.php"><img src="img/navbarplus.png" alt=""></a>
    <a href="main.php"><img src="img/navbarhome.png" alt=""></a>
    <a href="profile.php"><img src="img/navbarprofile.png" alt=""></a>
</nav>

</html>