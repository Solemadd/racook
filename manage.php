<!doctype html>
<html lang="en" class="light_body">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Racook</title>
  </head>


  <main class="newrecipe">
    <h2></h2>
    <h2>Ajout recette</h2><img src="img/couverts.png" alt="roue des paramètres">
    <form class="recette" action="">
        <input type="text" class="namerecipe" placeholder="Nom de la recette:">
        <h5>Préparation:
        <input type="number" name="quantite" id="" min="1" max="999"> <p>min</p>
        </h5><h5>Cuisson:<input type="number" name="quantite" id="" min="1" max="999"> <p>min</p></h5>
        <h5>Ingrédients:</h5>
        
        <select name="ingredient" id="">
            <option value="1">concombre</option>
        </select>
        <input type="number" name="quantite" id="" min="1" max="999">
        <select name="mesure" id="">
            <option value="1">g</option>
            <option value="2">Kg</option>
            <option value="3">L</option>
        </select>        
        <br>
        <button id="add"><h5>+</h5></button>
        <!--QUAND ON CLIQUE SUR LE BOUTTON IL FAUT QUE CA AJOUTE UN NOUVEAU CHAMP:-->

        <h5>Etapes:</h5>
        <textarea name="Text1" cols="40" rows="10"></textarea>
        <button id="add"><h5>+</h5></button>

    </form>

</main>


<nav class="downbar">
      <a href="manage.php"><img src="img/navbarplus.png" alt=""></a>
      <a href="main.php"><img src="img/navbarhome.png" alt=""></a>
      <a href="profile.php"><img src="img/navbarprofile.png" alt=""></a>
  </nav>

</html>