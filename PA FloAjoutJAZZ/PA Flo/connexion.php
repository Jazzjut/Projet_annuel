<?php //php du formulaire de connexion
require_once("init.php");
$pseudo = $_POST["pseudo"];
$mdp = $_POST["mdp"];

$requete = $db->prepare("SELECT pseudoC, mdpC FROM Client WHERE pseudoC = :pseudo");
$requete->bindParam(':pseudo', $pseudo);
$requete->execute();
$resultat = $requete->fetch();

if ($resultat) {
    if (password_verify($mdp, $resultat["mdpC"])) {
        echo "Connexion réussie.";
        $_SESSION['pseudo'] = $pseudo;
        echo $_SESSION['pseudo'];
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Utilisateur non trouvé.";
}
?>