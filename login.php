<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Racook</title>
  </head>

  <header>
    <a href="home.php"><img src="img/back.png" class="retour" alt="Retour"></a>
  </header>

  <main>
  <body id="screen">
    <img class="biglogo" src="img/logo.png" alt="LOGO">
    <form action="login.php" method="post" class="login">
        <h3>Connexion:</h3>
        <input type="text" name="email" class="login-input" placeholder="Adresse mail:" required>
        <input type="password" name="password" class="login-input" placeholder="Mot de passe:" required>
        <input type="submit" class="login send">
        <a href="register.php">Créer un compte</a>
    </form>

    <?php

      if(isset($_POST["email"]) && isset($_POST["password"])){
        $email = $_POST["email"];
        $pass = $_POST["password"];

        $db = new PDO('mysql:host=localhost;dbname=racook;charset=utf8mb4','root','');

        $data = $db->query('SELECT * FROM utilisateur')->fetchAll() ;

        $success = false;

        foreach ($data as $row){
            if ($email == $row['email'] and $pass == $row['password']){
                $success = true;
                header ('location: home.php');
                break;
            }
            else  {
              echo "<br> <p class='text-center'>Vous avez entré les mauvais identifiants. Essayez encore s'il vous plait. </p> <br>";
    
            }
        };
}
    ?>

  </body>
  </main>

</html>