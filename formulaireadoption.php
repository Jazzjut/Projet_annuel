<?php
// Connexion à la base de données
require_once("init.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupération des valeurs du formulaire
$Logement = $_POST['Logement'];
$Adresse = $_POST['Adresse'];
$Exterieur = isset($_POST['exterieur']) ? $_POST['exterieur'] : 'non'; // Si la case à cocher est cochée, la valeur sera 'oui', sinon 'non'
$NbHeure = $_POST['NbHeure'];
$Enfant = $_POST['Enfant'];
$Motif = $_POST['Motif'];
$Etat = 'en cours de traitement';

// Obtenir la date actuelle
$dateDuJour = date("Y-m-d");

// Préparation de la requête (premiere ligne les champs, seconde les marqueurs)
$requete = "INSERT INTO FormDemandeA (dateDemandeA, Logement, Adresse, ext, nbHSeul, nbEnf, raisonDemandeA, etatDemandeA)
VALUES (:dateDuJour, :Logement, :Adresse, :Exterieur, :NbHeure, :Enfant, :Motif, :Etat)";

// Préparation de la requête avec les marqueurs de nom
$ajout = $db->prepare($requete);

// Liaison des valeurs aux marqueurs de nom avec la méthode bindParam()
$ajout->bindParam(':dateDuJour', $dateDuJour);
$ajout->bindParam(':Logement', $Logement); // Lie la variable $logement au marqueur de nom :Logement
$ajout->bindParam(':Adresse', $Adresse); // Lie la variable $adresse au marqueur de nom :Adresse
$ajout->bindParam(':Exterieur', $Exterieur); // Lie la variable $extérieur au marqueur de nom :Extérieur
$ajout->bindParam(':NbHeure', $NbHeure); // Lie la variable $nbHeure au marqueur de nom :NbHeure
$ajout->bindParam(':Enfant', $Enfant); // Lie la variable $enfant au marqueur de nom :Enfant
$ajout->bindParam(':Motif', $Motif); // Lie la variable $motif au marqueur de nom :Motif
$ajout->bindParam(':Etat', $Etat);


// Exécution de la requête 
if ($ajout->execute()) {
    // Vérifiez si des lignes ont été affectées (insérées)
    if ($ajout->rowCount() > 0) {
        echo "Demande d'adoption enregistrée avec succès.";
    } else {
        echo "Erreur: Aucune ligne insérée.";
    }
} else {
    echo "Erreur: " . implode(", ", $ajout->errorInfo());
}

// Fermeture de la connexion à la base de données
$db = null;
?>
