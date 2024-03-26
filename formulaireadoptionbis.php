<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mon compte - Pattes en détresse</title>
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
                
                <form action="formulaireadoption.php" method="post">
                    <!-- il faudrait qu'il y est deux option soit adoption... -->
                    <h3><label for="">Numéro de demande :</label> <?php echo $formDemandeAID; ?><br></h3>
                    <!-- ne fonctionne pas encore le numéro de demande -->
                    <h3><label for="type_demande">Type de demande:</label></h3>
                    <select name="type_demande" id="type_demande">
                        <option value="adoption">Adoption</option>
                        <option value="remise">Remise à l'adoption</option>
                    </select>
                    <!-- il faudrait qu'il y est deux option soit adoption... -->
                    <!-- faudrait que le numéro d'adoption s'autoincrémente en fonction des formulaire créer comme les identifiants/ peut être modifier la base de données pour un ID formulaire  -->
                    <label for="dateDuJour"><h3>Date d'enregistrement</h3></label> <?php echo date("Y-m-d"); ?><br>

                    <!-- une variable pour reconnaitre la date du jour je peux pas faire  puisque mon fichier ne reconnais pas le php -->
                    <select id="Logement" name="Logement" required>
                        <option value="" disabled selected>Choisissez le type de logement</option>
                        <option value="maison">Maison</option>
                        <option value="appartement">Appartement</option>
                    </select><br><br><br>
                    <input type="text" id ="Adresse" name="Adresse" placeholder="xx rue,code postal VILLE" required>
                    <div class="exterieur-container">
                        <label for="exterieur" class="checkbox-label">Extérieur</label>
                        <input type="checkbox" id="exterieur" name="exterieur"value="oui">
                    </div>
                    <input type="number" id="NbHeure" name="NbHeure" placeholder="Nombre d'heures où l'animal seras seul par jour" required>
                    <input type="number" id="Enfant" name="Enfant" placeholder="Nombre d'enfant" required>
                    <textarea id="Motif" name="Motif" placeholder="Motif de l'adoption"></textarea>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
