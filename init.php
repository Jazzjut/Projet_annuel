<?php
// fichier qui regroupe et initialise : bd, la session, le chemin...
// BDD connec
$host = "localhost";
$database = "jjutea02";
$username = "jjutea02";
$password = "22000638";
try{
$db = new PDO("mysql:host=".$host.";dbname=".$database,$username,$password);
}
catch(PDOException $e){
die("<h1>Impossible de ce connecter a la base de données:</h1>" .$e);
}
echo 'Connexion réussie';
// la session
session_start();

// le chemin
define("RACINE_SITE","/site/");


//variable 
$contenu = '';

// autres choses qu'on ajoute en inclusion - ainsi on appel les deux fichiers (2 en 1)
require_once("fonction.php")
?>
