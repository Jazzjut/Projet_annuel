<?php
// fichier qui regroupe et initialise : bd, la session, le chemin...
// BDD connec
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
// la session
session_start();
?>
