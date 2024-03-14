<?php //php du formulaire de connexion
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

<?php // php du formulaire d'inscription
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
            header("Location: inscription.php");
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
