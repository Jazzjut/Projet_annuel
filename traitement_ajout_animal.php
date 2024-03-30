<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire ajout animal</title>
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
                <a href="adoption.html"><button>> Adopter un animal</button></a>
                <a href="mettreadoption.html"><button>> Mettre à l'adoption</button></a>
                <a href="don.html"><button>> Faire un don</button></a>
            </div>
        </div>
        <div class="partie-droite">
        <div class="formulaire">
        <h2>Ajouter un animal</h2>
        <form action="traitement_ajout_animal.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom de l'animal:</label>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="age">Âge de l'animal:</label>
        <select id="age" name="age" required>
            <option value="Junior">Junior 0 - 2 ans</option>
            <option value="Adulte">Adulte 3 - 10 ans</option>
            <option value="Senior">Senior plus de 11 ans</option>

        </select><br><br>

        <label for="espece">Espèce:</label>
        <select id="espece" name="espece" required>
            <option value="Chien">Chien</option>
            <option value="Chat">Chat</option>
        </select><br><br>

        <label for="sexe">Sexe:</label>
        <select id="sexe" name="sexe" required>
            <option value="M">Mâle</option>
            <option value="F">Femelle</option>
        </select><br><br>

        <label for="race">Race:</label>
        <input type="text" id="race" name="race" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

        <label for="photo">Photo de l'animal:</label>
        <input type="file" name="image"/><br>

        <label for="ville_refuge">Ville du refuge:</label>
        <select id="ville_refuge" name="ville_refuge" required>
            <option value="Poitiers">Poitiers</option>
            <option value="Toulouse">Toulouse</option>
            <option value="Lyon">Lyon</option>
            <option value="Paris">Paris</option>
            <option value="Clermont-Ferrand">Clermont-Ferrand</option>
            <option value="Strasbourg">Strasbourg</option>
        </select><br><br>

        <button name="valider" type="submit">Valider l'ajout</button>
    </form>
</div>
</div>
</body>
</html>

<?php
require_once("init.php"); //  fichier d'initialisation

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["valider"])) {
    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $age = $_POST["age"];
    $espece = $_POST["espece"];
    $sexe = $_POST["sexe"];
    $race = $_POST["race"];
    $description = $_POST["description"];
    $ville_refuge = $_POST["ville_refuge"];
    $etat = 'en cours de traitement';

    // la requête SQL
    $requete = "INSERT INTO Pet(prenomP, espece, sexeP, locaP, race, ageP, etatP, formMiseAID, formDemandeAID) 
    VALUES (:nom, :espece, :sexe, :ville_refuge, :race, :age, :etat, NULL, NULL)";
    $ajout = $db->prepare($requete);

    // Insérer les données dans la table Pet
    $ajout->bindParam(':nom', $nom);
    $ajout->bindParam(':espece', $espece);    
    $ajout->bindParam(':sexe', $sexe);
    $ajout->bindParam(':ville_refuge', $ville_refuge);
    $ajout->bindParam(':race', $race);
    $ajout->bindParam(':age', $age);
    $ajout->bindParam(':etat', $etat);

    // Exécution de la requête
    if ($ajout->execute()) {
        // Récupérer l'ID du nouvel animal ajouté
        $petID = $db->lastInsertId();
        
        if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            $ajoutImage = $db->prepare("INSERT INTO image (nom, taille, type, bin, petID) VALUES (?, ?, ?, ?, ?)");
            $ajoutImage->execute(array(
                $_FILES["image"]["name"],
                $_FILES["image"]["size"],
                $_FILES["image"]["type"],
                file_get_contents($_FILES["image"]["tmp_name"]),
                $petID
            ));
            echo "Demande de mise à l'adoption enregistrée avec succès.";
            header("Location: accueil.html");
            exit; // Assurez-vous de terminer le script après la redirection
        } else {
            echo "Échec du téléchargement du fichier avec le code d'erreur : " . $_FILES["image"]["error"];
        }
    } else {
        echo "Erreur lors de l'enregistrement de la demande de mise à l'adoption.";
    }
}

// Fermeture de la connexion à la base de données
$db = null;
?>
