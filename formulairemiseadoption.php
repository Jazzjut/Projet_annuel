<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulaire d'adoption</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <div class="partie-gauche">
            <div class="logo">
                <img src="Logo.png" alt="Logo" />
            </div>
            <div class="bouton">
                <a href="compte.html"><button>Mon compte</button></a>
                <a href="accueil.html"><button>Accueil</button></a>
                <a href="adoption.html"><button>> Adopter un animal</button></a>
                <a href="mettreadoption.html"><button>> Mettre à l'adoption</button></a>
                <a href="don.html"><button>> Faire un don</button></a>
            </div>
        </div>
        <div class="partie-droite">
            <div class="formulaire">
                <form action="recapitulatifmiseadoption.php" method="post">
                    <label for="dateDuJour">
                        <h3>Date d'enregistrement</h3>
                    </label> <?php echo date("Y-m-d"); ?><br>
                    <input type="mail" id ="mail" name="mail" placeholder="exemple@gmail.com" required>
                    <textarea id="Motif" name="Motif" placeholder="Motif de l'adoption"></textarea>
                    <select name="espece">
                        <option value="">Sélectionnez l'espèce</option>
                        <option value="Chien">Chien</option>
                        <option value="Chat">Chat</option>
                    </select>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php 
require_once("init.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // Récupération des valeurs du formulaire
