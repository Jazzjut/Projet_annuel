<?php
require_once("inc/init.php");
// pour voir les erreurs 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $pseudo = $_POST["pseudo"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
    $ville = $_POST["ville"];
    $codepostal = $_POST["code_postal"];
    $adresse = $_POST["adresse"];
    $tel = '0123456789';

    $requete = "INSERT INTO Client (pseudoC, nomC, prenomC, mailC, telC, mdpC, adresseC, code_postalC, villeC)
    VALUES (:pseudo, :nom, :prenom, :email, :tel, :mdp, :adresse, :codepostal, :ville)";

    $ajout = $db->prepare($requete);
    $ajout->bindParam(':pseudo', $pseudo);
    $ajout->bindParam(':nom', $nom);
    $ajout->bindParam(':prenom', $prenom);
    $ajout->bindParam(':email', $email);
    $ajout->bindParam(':tel', $tel);
    $ajout->bindParam(':mdp', password_hash($mdp, PASSWORD_DEFAULT));
    $ajout->bindParam(':adresse', $adresse);
    $ajout->bindParam(':codepostal', $codepostal);
    $ajout->bindParam(':ville', $ville);

    if ($ajout->execute()) {
        if ($ajout->rowCount() > 0) {
            header("Location: inscription.html");
            exit;
        } else {
            echo "Erreur.";
        }
    } else {
        echo "Erreur : " . implode(", ", $ajout->errorInfo());
    }

// Fermer la connexion à la base de données
$db = null;
?>
<?php
require_once("inc/init.php");?>
<?php
require_once("inc/haut.inc.php");?>

<form method="post" action="inscription.php">
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="votre pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." required="required"><br><br>
    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" required="required"><br><br>
    <label for="nom">Nom</label><br>
    <input type="text" id="nom" name="nom" placeholder="votre nom"><br><br>

    <label for="prenom">Prénom</label><br>
    <input type="text" id="prenom" name="prenom" placeholder="votre prénom"><br><br>
    <label for="email">Email</label><br>
    <input type="email" id="email" name="email" placeholder="exemple@gmail.com"><br><br>
    <label for="ville">Ville</label><br>
    <input type="text" id="ville" name="ville" placeholder="votre ville" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés : a-zA-Z0-9-_."><br><br>

    <label for="code_postal">Code Postal</label><br>
    <input type="text" id="code_postal" name="code_postal" placeholder="code postal" pattern="[0-9]{5}" title="5 chiffres requis : 0-9"><br><br>

    <label for="adresse">Adresse</label><br>
    <textarea id="adresse" name="adresse" placeholder="votre dresse" pattern="[a-zA-Z0-9-_.]{5,15}" title="caractères acceptés :  a-zA-Z0-9-_."></textarea><br><br>

    <input type="submit" name="inscription" value="S'inscrire">
</form>
<?php require_once("inc/bas.inc.php");
?>
