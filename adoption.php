<?php 
require_once("init.php"); //Connexion à la base de données
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Requête pour récupérer les animaux avec leurs images
$sql = "SELECT Pet.*, image.nom AS image_nom, image.type AS image_type, image.bin AS image_bin FROM Pet LEFT JOIN image ON Pet.petID = image.petID";
$result = $db->query($sql);
?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Adoption - Pattes en détresse</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="container">
      <div class="partie-gauche">
        <div class="logo">
          <img src="Logo.png" alt="Logo" />
        </div>
        <div class="bouton">
          <a href="compte.html"><button>Mon compte</button></a>
          <a href="accueil.html"><button>Accueil</button></a>
        </div>
        <div class="formulaire">
          <!-- Recherche avec les filtres -->
          <form action="recherche.php" method="post">
            <!-- chercher prenom -->
            <input
              type="text"
              name="race"
              class="champ-race"
              placeholder="Prénom"
            /><select name="espece">
              <option value="">Sélectionnez l'espèce</option>
              <option value="Chien">Chien</option>
              <option value="Chat">Chat</option>
            </select>
            <select name="race">
              <option value="">Sélectionnez la race</option>
              <!-- rajouter d'autre option ex = si la base de données posséde un chat de la race Angora faudrait qu'elle se mette automatiquement dedans -->
            </select>
            <select name="sexe">
              <option value="">Sélectionnez le sexe</option>
              <option value="Mâle">Mâle</option>
              <option value="Femelle">Femelle</option>
            </select>
            <select name="age">
              <option value="">Sélectionnez l'age</option>
              <option value="Junior">Junior</option>
              <option value="Adulte">Adulte</option>
              <option value="Senior">Sénior</option>
            </select>
            <select name="localisation">
              <option value="">Sélectionnez la localisation</option>
              <option value="Poitiers">Poitiers</option>
              <option value="Toulouse">Toulouse</option>
              <option value="Lyon">Lyon</option>
              <option value="Paris">Paris</option>
              <option value="Clermont-Ferrand">Clermont-Ferrand</option>
              <option value="Strasbourg">Strasbourg</option>
            </select>

            <!-- class="champ-race" => pour qu'il fasse la même taille en largeur que les menus déroulants mais sa na pas fonctionné  -->
            <button type="submit">Rechercher</button>
          </form>
        </div>
      </div>
      <div class="partie-droite">
        <div class="presentation-animaux">
        <?php
          if ($result->rowCount() > 0) {
            // Affichage des animaux
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              echo "<div class='animal'>";
              echo "<img src='data:{$row['image_type']};base64," . base64_encode($row['image_bin']) . "' alt='{$row['prenomP']}' />";
              echo "<div class='bouton2'><a href='fichedescriptif.html'><h3>{$row['prenomP']}</h3></a></div>";
              echo "<p>Sexe: {$row['sexeP']}</p>";
              echo "</div>";
            }
          } else {
            echo "Aucun animal trouvé.";
          }
          ?>
          </div>          
    </div>
  </body>
</html>
