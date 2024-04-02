<?php
require_once("init.php"); //  fichier d'initialisation

// Affichage des erreurs 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si le formulaire a été soumis
if (isset($_POST['valider'])) {
    // Récupérer les données du formulaire
    $formMiseAID = $_SESSION['formMiseAID'];
    $mail = $_SESSION['mail'];
    $motif = $_SESSION['motif'];
    $etat = 'en cours de traitement';
    $date = date("Y-m-d");

    
    // la requête SQL
    $requete = "INSERT INTO FormMiseA(formMiseAID, dateMiseA, raisonMiseA, etatMiseA, mailC, petID) 
    VALUES (:formMiseAID, :date, :motif, :etat, :mail, NULL)";
$ajout = $db->prepare($requete);

// Liaison des paramètres
$ajout->bindParam(':formMiseAID', $formMiseAID);
$ajout->bindParam(':mail', $mail);
$ajout->bindParam(':motif', $motif);
$ajout->bindParam(':etat', $etat);
$ajout->bindParam(':date', $date);

// Exécution de la requête
if ($ajout->execute()) {
echo "Demande de mise à l'adoption enregistrée avec succès.";
} else {
echo "Erreur lors de l'enregistrement de la demande de mise à l'adoption.";
}

}elseif (isset($_POST['annuler'])) {
    // Si l'utilisateur clique sur "Annuler", ne rien faire
    header("Location: accueil.html");
}
// Fermeture de la connexion à la base de données
$db = null;
