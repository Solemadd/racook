<?php session_start(); ?>
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

  <a href="main.php"><img src="img/back.png" class="retour" alt="Retour"></a>


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

  if ($row['ID'] == $_GET['id']) {
  echo '

  <main class="affichage" style="margin-top:5%">
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
              <br>';
            }
            };'
      <h6>Cuisson:</h6>
          <p>'.$row['temps_cuisson'].'min</p>
      <h6>Etapes:</h6>
          <p>'.$row['etape'].'</p>
      </div>
    </article>
</main>

'

;}
}
  ?>

<main class="newrecipe"><form action="" method="post">
  <button style="background-color:transparent; margin:0;"><?php 
if ($_POST){
  if($_POST['fnc']== 'like'){

  $db = new PDO("mysql:host=localhost;dbname=racook;charset=utf8mb4", "root", "");
  $likedata = $db->query('SELECT * FROM aime WHERE ID_recette = '.$_GET['id'].' AND ID_utilisateur = '.$_SESSION['id'].'');
  $liked = false;
  $abort = false;

  foreach($likedata as $likerow){
    if ($likerow['ID_utilisateur'] == $_SESSION['id']){ $liked=true; $abort = true;
      if ($_POST){
      if($_POST['fnc']== 'like'){
        $user = $_SESSION['id'];
        $recette = $_POST['id'];

        $stmt = $db->prepare("DELETE FROM aime WHERE ID = ".$likerow['ID']."");
        $stmt->execute();
        $liked=false;
      }}}}
    
    
  
    
    if (!$liked AND !$abort){
      if ($_POST){
      if($_POST['fnc']== 'like'){
        foreach($likedata as $likerow){

        }

      $user = $_SESSION['id'];
      $recette = $_POST['id'];

      $stmt = $db->prepare("INSERT INTO aime (ID_utilisateur, ID_recette) VALUES (:ID_utilisateur, :ID_recette)");
      
      $stmt->bindParam(":ID_utilisateur", $user);
      $stmt->bindParam(":ID_recette", $recette);

      $stmt->execute();
      $liked= true;}}}
    
    if($liked){echo('<img src="img/like.png" alt="liké">');}else{echo('<img src="img/notliked.png" alt="pas liké">');}
    
 
      }}?></button>
<input type="hidden" name="fnc" value="like">
<input type="hidden" name="id" value="<?php echo($_GET['id']);?>">
</form></main>





<main class="newrecipe">
    <hr class="primary width100">
  <h5>Publier un commentaire:</h5>
      <form action="affichage.php?id=<?php $_GET["id"] ?>" style="margin-top: 5%;" method="post">
        <input type="text" name="titre" placeholder="Titre:">
        <h1></h1>
        <textarea name="commentaire" id="" cols="30" rows="6" placeholder="Comentaire:"></textarea>
        <input type="submit" style="margin-top: 5%;"> 
        <input type="hidden" name="id" value="<?php echo($_GET['id']);?>">
        <input type="hidden" name="fnc" value="comm">
      </form>





    
      <?php

  if (isset($_POST["titre"]) && isset($_POST["commentaire"])){
  $titre = $_POST["titre"];
  $commentaire = $_POST["commentaire"];
  $user = $_SESSION['id'];
  $recette = $_POST['id'];


  $db = new PDO("mysql:host=localhost;dbname=racook;charset=utf8mb4", "root", "");

  

  $stmt = $db->prepare("INSERT INTO commentaire (titre_com, contenu_com, ID_utilisateur, ID_recette) VALUES (:titre_com, :contenu_com, :ID_utilisateur, :ID_recette)");
  $stmt->bindParam(":titre_com", $titre);
  $stmt->bindParam(":contenu_com", $commentaire);
  $stmt->bindParam(":ID_utilisateur", $user);
  $stmt->bindParam(":ID_recette", $recette);

  $stmt->execute();

  
  echo '<div>
  <strong>C est nickel</strong> l\'ajout est OK.
  </div>';
}

    ?>





<h4>Commentaires:</h4>
<?php

$db = new PDO("mysql:host=localhost;dbname=racook;charset=utf8mb4", "root", "");

$data_commentaire = $db->query("SELECT * FROM commentaire
                                 INNER JOIN recette
                                 ON commentaire.ID_recette = recette.ID
                                 INNER JOIN utilisateur
                                 ON commentaire.ID_utilisateur = utilisateur.ID")->fetchAll();




    foreach ($data_commentaire as $row_commentaire){


      if ($_GET['id'] == $row_commentaire['ID_recette']) {
        echo '
        <br>
        <section class="carte" style="margin: 0;margin-top:5%;margin-left:2%;">
        <h5>'.$row_commentaire['titre_com'].'</h5>
        <h6>Utilisateur: '.$row_commentaire['username'].'</h6>
        <p>'.$row_commentaire['contenu_com'].'</p></section>
        ';
      }
      }
;

  ?>

  <br style="margin-top:10%">
</main>



</html>