<?php //php du formulaire de recherche adoption
require_once("init.php"); //Connexion à la base de données

// Récupère les paramètres de recherche
$nom = $_POST['nom'];
$race = $_POST['race'];
$espece = $_POST['espece'];
$sexe = $_POST['sexe'];
$age = $_POST['age'];
$localisation = $_POST['localisation'];

// Construit la requête SQL en fonction des paramètres de recherche
$requete = "SELECT * FROM Pet WHERE 1"; // 1 est toujours vrai, donc nous commençons par cela

// Ajoute les conditions de recherche si les paramètres sont définis
if (!empty($race)) {
    $requete .= " AND race LIKE '%$race%'";
}
if (!empty($nom)) {
    $requete .= " AND prenomP = '$nom'";
}
if (!empty($espece)) {
    $requete .= " AND espece = '$espece'";
}
if (!empty($sexe)) {
    $requete .= " AND sexeP = '$sexe'";
}
if (!empty($age)) {
    $requete .= " AND ageP = '$age'";
}
if (!empty($localisation)) {
    $requete .= " AND locaP = '$localisation'";
}


// Exécute la requête
$test = $db->prepare($requete);
$test->execute();

// Affiche les résultats
if ($test->rowCount() > 0) {
    while ($row = $test->fetch(PDO::FETCH_ASSOC)) {
        // Génère le code HTML pour afficher les résultats
        echo '<div class="animal">';
        echo '<img src="' . $row['image'] . '" />';
        echo '<div class="bouton2">';
        echo '<a href="fichedescriptif.html"><h3>' . $row['nom'] . '</h3></a>';
        echo '</div>';
        echo '<p>Sexe: ' . $row['sexe'] . '</p>';
        echo '</div>';
    }
} else {
    echo "Aucun résultat trouvé";
}

// Ferme la connexion à la base de données
$db->close();
?>