<?php session_start(); echo($_SESSION['id']);?>
<!doctype html>
<html lang="en" class="light_body">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Racook</title>
  </head>


  <main class="newrecipe">
    <a href="profile.php"><img src="img/back.png" class="retour" alt="Retour"></a> <br class="margin10">
    <h2></h2>
    <h2>Mon Compte:</h2><img src="img/navbarprofile.png" alt="roue des paramètres">
    <form class="recette" action="" method="POST">
      <?php

      $db = new PDO('mysql:host=localhost;dbname=racook;charset=utf8mb4','root','');

      $data = $db->query('SELECT * FROM utilisateur where ID = '.$_SESSION['id'].'')->fetchAll() ;

      if ($_POST){
        $stmt = $db->prepare("
        UPDATE utilisateur 
        SET prenom = '".$_POST['prenom']."' , nom = '".$_POST['nom']."', age= '".$_POST['age']."', username = '".$_POST['pseudo']."', email= '".$_POST['email']."', password= '".$_POST['password']."' 
        WHERE ID = ".$_SESSION['id']."");

        $stmt->execute();
      }

    $data = $db->query('SELECT * FROM utilisateur where ID = '.$_SESSION['id'].'')->fetchAll() ;

    foreach($data as $row){

      echo('
      <h5>Pseudo</h5>
      <input type="text" name ="pseudo" class="namerecipe" placeholder="Pseudo:" value="'.$row['username'].'">
      <h5>Nom</h5>
        <input type="text" name ="nom" class="namerecipe" placeholder="Nom:" value="'.$row['nom'].'">
        <h5>Prénom</h5>
        <input type="text" name ="prenom" class="namerecipe" placeholder="Prénom:" value="'.$row['prenom'].'">
        <br class="margin10">
        <h5>Mail</h5>
        <input type="email" name ="email" class="namerecipe" placeholder="Mail:" value="'.$row['email'].'">
        <br class="margin10">
        <h5>Mot de passe:</h5>
        <input type="password" name ="password" class="namerecipe" placeholder="Mot de passe:" value="'.$row['password'].'">
        <br class="margin10">
        <h5>Age</h5>
        <input type="number" min="13" max="130" name ="age" class="namerecipe" value="'.$row['age'].'">
        <br class="margin10">
        <button class="margin5" style="background-color: green;font-size: 1rem;">Valider les modifications</button>
        
        </form>');}
      ?>
      <form>
      <button class="margin5" style="background-color: #e8cd93; font-size: 1rem;">Telecharger mes données</button>
        <button class="margin5" style="background-color: red;font-size: 1rem;">Supprimer mon compte</button>
      </form>

        <a href="docs/RGPD_Racook.pdf">Accords de confidentialité</a>
        <a href="docs/Mention_Legal_Racook.pdf">Mention légales</a>
</main>




<nav class="downbar">
    <a href="manage.php"><img src="img/navbarplus.png" alt=""></a>
    <a href="main.php"><img src="img/navbarhome.png" alt=""></a>
    <a href="profile.php"><img src="img/navbarprofile.png" alt=""></a>
</nav>

</html>