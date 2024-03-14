<?php // php du formulaire d'inscription
require_once("init.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $pseudo = $_POST["pseudo"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
    $tel = $_POST["tel"];

    $requete = "INSERT INTO Client (pseudoC, nomC, prenomC, mailC, telC, mdpC)
    VALUES (:pseudo, :nom, :prenom, :mail, :tel, :mdp)";

    $ajout = $db->prepare($requete);
    $ajout->bindParam(':pseudo', $pseudo);
    $ajout->bindParam(':nom', $nom);
    $ajout->bindParam(':prenom', $prenom);
    $ajout->bindParam(':mail', $mail);
    $ajout->bindParam(':tel', $tel);
    $ajout->bindParam(':mdp', $mdp);

    if ($ajout->execute()) {
        if ($ajout->rowCount() > 0) {
            header("Location: accueil.html");
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
