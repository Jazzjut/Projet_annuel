<?php
$host = "localhost";
$database = "flempere";
$username = "flempere";
$password = "22006880";
try{
$db = new PDO("mysql:host=".$host.";dbname=".$database,$username,$password);
}
catch(PDOException $e){
die("<h1>Impossible de ce connecter a la base de données:</h1>" .$e);
}

$pseudo = $_POST["pseudo"];
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$mdp = password_hash($_POST["mdp"], password_default);
$ville = $_POST["ville"];
$codepostal = $_POST["code_postal"];
$adresse = $_POST["adresse"];

$requete = "INSERT INTO Client (pseudoC, nomC, prenomC, mailC, mdpC, adresseC, code_postalC, villeC VALUES ('$pseudo', '$nom', '$prenom', '$email', '$mdp', '$adresse', '$codepostal', '$ville')";

if ($db->query($requete) === TRUE){
    echo "Compte créé avec succès";
}else{
    echo "Erreur : " .$db->error;
}
?>