<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Récapitulatif</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container">
        <div class="partie-droite">
            <div class="formulaire">
                <h2>Récapitulatif de votre demande de mise à l'adoption</h2>
                <?php
                require_once("init.php");
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                $formMiseAID = crc32(uniqid());
                $mail = $_POST['mail'];
                $motif = $_POST['Motif'];
                $espece = $_POST['espece'];
                $date = date("Y-m-d");

                $_SESSION['formMiseAID'] = $formMiseAID;
                $_SESSION['mail'] = $mail;
                $_SESSION['motif'] = $motif;
                $_SESSION['espece'] = $espece;
                $_SESSION['date'] = $espece;
                // Traitement des données et requête SQL ici

                // Affichage des données récapitulatives
                echo "<p><strong>Numéro de demande :</strong> $formMiseAID</p>";
                echo "<p><strong>mail :</strong> $mail</p>";
                echo "<p><strong>Date de la demande :</strong> $date</p>";
                echo "<p><strong>Motif de l'adoption :</strong> $motif</p>";
                echo "<p><strong>L'espece de l'animal :</strong> $espece</p>";

                // Boutons de validation et d'annulation
                echo "<form class='formulaire' action='traitementmiseadoption.php' method='post'>";
                echo "<button type='submit' name='valider' value='Valider'>Valider</button>";
                echo "<button type='submit' name='annuler' value='Annuler'>Annuler</button>";
                echo "</form>";
                ?>
            </div>
        </div>
    </div>
</body>

</html>