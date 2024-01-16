<?php
require("connect.php");
$login = $_POST['login'];
$password = $_POST['password'];

$requete = $db->prepare("SELECT * FROM Connexion WHERE pseudo =:pseudo AND mdp = :mdp");
$requete->bindParam(':pseudo',$login);
$requete->bindParam(':mdp',$password);
$requete->execute();
if ($requete->rowCount() > 0 ){
echo "connexion réussi";
}
