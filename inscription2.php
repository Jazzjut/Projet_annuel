<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("init.php");

    $pseudo = $_POST["pseudo"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $mdp = password_hash($_POST["mdp"], PASSWORD_DEFAULT);
    $ville = $_POST["ville"];
    $codepostal = $_POST["code_postal"];
    $adresse = $_POST["adresse"];
    $dateNaissance = 2000;
    $tel = '0123456789';

    $requete = "INSERT INTO Client (pseudoC, nomC, prenomC, mailC, telC, mdpC, adresseC, code_postalC, villeC, dateNC)
    VALUES (:pseudo, :nom, :prenom, :email, :tel, :mdp, :adresse, :codepostal, :ville, :dateNaissance)";

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
    $ajout->bindParam(':dateNaissance', $dateNaissance);

    if ($ajout->execute()) {
        if ($ajout->rowCount() > 0) {
            echo "Ok";
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