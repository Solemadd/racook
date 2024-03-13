<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Racook</title>
  </head>

  <header>
    <a href="login.php"><img src="img/back.png" class="retour" alt="Retour"></a>
  </header>

  <main>
  <body id="screen">
    <img class="biglogo" src="img/logo.png" alt="LOGO">
    <form action="register.php" method="post" class="login">

        <h3>Inscription:</h3>

        <input type="mail" name="email" placeholder="Adresse mail:" required="true">
        <input type="text" name="username" placeholder="Nom d'utilisateur:" required="true">
        <hr class="lighter width90">
        <input type="text" name="prenom" placeholder="Prénom:" required="true">
        <input type="text" name="nom" placeholder="Nom de famille:" required="true">
        <input type="number" name="age" min="13" max="130" placeholder="Age" required="true">
        <hr class="lighter width90">
        <input type="password" name="password" placeholder="Mot de passe:" required="true">
        <input type="password" name="password2" class="login-input" placeholder="Vérifiez votre mot de passe:" required>
        


        <p>J'accepte les</p><a href="docs/RGPD_racook.pdf">politiques de confidentialités</a>
          <input type="checkbox" required="true"></input>
        
        <input type="submit" class="button">
    </form>

    <?php

if (isset($_POST["password"]) && isset($_POST["password2"])) {
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  if ($password === $password2) {
  if (isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["prenom"]) && isset($_POST["nom"]) && isset($_POST["age"]) && isset($_POST["password"])){
  $email = $_POST["email"];
  $username = $_POST["username"];
  $prenom = $_POST["prenom"];
  $nom = $_POST["nom"];
  $age = $_POST["age"];
  $password = $_POST["password"];
  $role = '4';


  $db = new PDO("mysql:host=localhost;dbname=racook;charset=utf8mb4", "root", "");

  $stmt = $db->prepare("INSERT INTO utilisateur (prenom, nom, age, username, email, password , ID_role) VALUES (:prenom, :nom, :age, :username, :email, :password, :roles)");
  $stmt->bindParam(":prenom", $prenom);
  $stmt->bindParam(":nom", $nom);
  $stmt->bindParam(":age", $age);
  $stmt->bindParam(":username", $username);
  $stmt->bindParam(":email", $email);
  $stmt->bindParam(":password", $password);
  $stmt->bindParam(":roles", $role);

  $stmt->execute();

  
  echo '<div>
  <strong>C est nickel</strong> l\'ajout est OK.
  </div>';
}}else{
  echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
}}

    ?>


    </body>
  </main>
  
</html>