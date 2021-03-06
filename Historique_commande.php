<?php
	// Récupération des données de la session
	session_start();

	// Vérifie si l'utilisateur est connecté, sinon redirection vers la page de connexion
	if(!isset($_SESSION["username"])){
		header("Location: login.php");
		exit(); 
	}
    //appel du fichier connexion.php
    require("Connexion/connexion.php");
    $co = connexionBdd();
    
    //initialisation des variables
    $dateDebut = $dateFin = 0;
    $filtreOk = True;
    $errorHeure = $errorWeekend = $errorDateSupp = $ErrorValue = $heureL = $HeureActuel = $errorHeureChoix = $errorDate = $errorFiltre = $errorSaisie = "";
    
    $date = new DateTime(); // objet date qui utilise la date et l'heure courante
    $dt= $date->format('Y-m-d'); 
    
    //requete pour afficher l'utilisateur
    $reqUtilisateur = $co->prepare("SELECT * FROM utilisateur WHERE email_user = ?");
    $reqUtilisateur->execute(array($_SESSION["username"]));
    $uti = $reqUtilisateur->fetch();
    include("./Historique_commande/actionButton/actionButton.php");
?>
<DOCTYPE html>
<html>
    <head>  
        <title>Page historique de commande</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <link href="../Historique_commande/hist_com.css" rel="stylesheet">
        <meta charset="utf-8">
        <script src="./Historique_commande/menu_hist_com.js"></script>
    </head>
    <body>  
        <!--bouton pour afficher la sidebar-->
        <div id="main">
            <button class="openbtn" onclick="openNav()">Menu</button>  
        </div>
        <!--affichage de la sidebar-->
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <?php
                //requete pour afficher les filtres de l'utilisateur
                $reqFiltre = $co->prepare("SELECT * from historique WHERE fk_user_id = ?");
                $reqFiltre->execute(array($uti["id_user"]));
                $date = $reqFiltre->fetch();
                // On compte le nombre de lignes résultats de la requête
                $nbFiltres = $reqFiltre->rowCount();
                //si dans la base de donnée l'utilisateur possède au moins un filtre alors le filtre de début et de fin sont ajoutés à 2 variables
                if($nbFiltres > 0)
                {
                    //variable filtre de début
                    $dateDebut = $date["dateDebut_hist"];
                    //variable filtre de fin
                    $dateFin = $date["dateFin_hist"];
                }
                //si il n'y a pas de filtre alors on demande la saisie d'un filtre
                else
                {
                    //s'il n'y a pas de filtre alors la variable filtreOk passe a False pour l'affiche du formulaire
                    $filtreOk = False;
                    //affichage alerte en js pour prévenir que l'utilisateur n'a pas de filtre
                    echo "<script>alert(\"il n'y a pas de filtre\")</script>";
                }
                echo "<a class='menu_element' href='index.php'>Accueil</a>";
                //affichage du nom de l'utilisateur
                echo"<h3>".$uti["nom_user"]."</h3>";
                //affichage du prénom de l'utilisateur
                echo"<h3>".$uti["prenom_user"]."</h3>";
                echo "<a class='menu_element' href='reservationSandwich.php'>Commander</a>";
                echo "<h3>Modifier le filtre</h3>";
                //formulaire pour modifier le filtre de l'affichage des commandes
                echo "<form method='post' name='updateFilter' action='' class='text-center'>";
                    echo "<div class='marginButton'>";
                        //bouton modification début du filtre
                        echo "<input name='startFilter' type='date' value='".$dateDebut."'>";
                        //bouton modification fin du filtre
                        echo "<input name='endFilter' type='date' value='".$dateFin."'><br>";
                    echo "</div>";
                    echo "<button name='updateFilter' class='bouton_delete' type='submit' value=''>Appliquer le filtre</button>";
                    echo "<h3 class='text-center'>".$errorFiltre."</h3>";
                    echo "<h3 class='text-center'>".$errorSaisie."</h3>";
                echo "</form>";
            ?>
            <a class="menu_element" href="Connexion/deconnexion.php">Déconnexion</a>
        </div>
        <!--si la variable filtreOk est en False alors affichage du formulaire-->
        <div style="display:<?php if($filtreOk) echo 'none';?> ">
            <!--formulaire pour la saisie du filtre-->
            <form method='post' name='saisieFiltre' action='' class='text-center'>
                <!--champ de saisie pour le début du filtre-->
                <input name='startFilter' type='date'>
                <!--champ de saisie pour la fin du filtre-->
                <input name='endFilter' type='date'>
                <!--ajout du filtre-->
                <button name='btnAjoutFiltre' class='Ajout' type='submit'>Ajouter un nouveau filtre</button>
            </form>
            <p><?php echo $errorSaisie; ?></p>
        </div>
        <!--Affichage des commandes de l'utilsateur-->
        <?php
            //jointure pour afficher le sandwich
            $reqSandwich = $co->prepare("SELECT * FROM sandwich INNER JOIN commande on sandwich.id_sandwich = commande.fk_sandwich_id");
            $reqSandwich->execute();
            $sandwich = $reqSandwich -> fetch();
            //jointure pour afficher la boisson
            $reqBoisson = $co->prepare("SELECT * FROM boisson INNER JOIN commande ON boisson.id_boisson = commande.fk_boisson_id");
            $reqBoisson->execute();
            $boisson = $reqBoisson -> fetch();
            //jointure pour afficher le dessert
            $reqDessert = $co->prepare("SELECT * FROM dessert INNER JOIN commande ON dessert.id_dessert = commande.fk_dessert_id");
            $reqDessert->execute();
            $dessert = $reqDessert -> fetch();
            //affichage des commandes;
            $reqAffichage = $co->prepare("SELECT * FROM commande WHERE date_heure_livraison_com >= ? AND date_heure_livraison_com <= ? AND fk_user_id = ? ORDER BY date_heure_livraison_com ASC ");
            $reqAffichage->execute(array($dateDebut, $dateFin, $uti["id_user"]));
            //boucle while pour afficher les commandes
            while($row = $reqAffichage -> fetch())
            {
                //la variable $dateCom prend la valeur de la date de la commande
                
                $dateCom = new DateTime($row["date_heure_livraison_com"]);
                echo "<div class='container contenu_com'>";
                    echo "<div class='text-center'>";
                    ?>
                        <div style="background-color: <?php if($row["annule_com"] == 1) echo"818181"?>" class='contenu'>
                        <?php
                            //affichage si la commande est annulée
                            if($row["annule_com"] == 1)
                            {
                                echo "<h3 class='com_annule'>La commande est annulée</h3>";
                            }
                            //affichage de la date et heure de livraison de la commande
                            echo "<h3 class='date_commande'>Commande du ".$dateCom->format('d-m-Y H:i:s')."</h3>";
                            //affichage du contenu de la commande (sandwich, boisson, dessert et chips)
                            echo "<p class='background_commande'>";
                                //affichage du sandwich
                                echo "nom du sandwich : ".$sandwich["nom_sandwich"]."<br>";
                                //affichage de la boisson
                                echo "nom de la boisson : ".$boisson["nom_boisson"]."<br>";
                                //affichage du dessert
                                echo "nom du dessert : ".$dessert["nom_dessert"]."<br>";
                                //affichage des chips si $row["chips_com"] est égale à 1
                                if($row["chips_com"] == 1)
                                {
                                    echo "paquet de chips";
                                }
                                else
                                {
                                    echo "Aucun paquet de chips";
                                }
                            echo "</p>";
                            //formulaire pour modifier la date de livraison de la commande 
                            ?>
                            <div style="background-color: <?php if($row["annule_com"] == 1) echo"818181"?>">
                                <?php
                                    if($row["annule_com"] == 0)
                                    {
                                        echo "<form method='post' name='button-Up-De' action='' class='formModif'>";
                                            echo "<h4>Modifier la date de la commande</h4>";
                                            ?>
                                            <div id="dateHeure">
                                                <?php
                                                    echo'<input type="date" name="date" value="'.$dt.'">';
                                                ?>
                                                <select name="heure">
                                                    <option value="<?php $heure; ?>" name="desac" disabled selected> Heure de réservation </option>
                                                    <option value="11:40"> 11:40 </option>
                                                    <option value="12:35"> 12:35 </option>
                                                </select>
                                                <small class="error" id ="errorHeureChoix"> <?php echo $errorHeureChoix; ?> </small>
                                            </div>
                                            <?php
                                            echo "<div class='marginButton'>";
                                                //bouton pour modifier la date de livraison
                                                echo "<button name='btnModifLivraison' class='bouton_update' type='submit' value=".$row["id_com"].">Modifier la date de commande</button>";
                                                //bouton pour annuler la commande
                                                echo "<button name='btnSupprLivraison' class='bouton_delete' type='submit' value=".$row["id_com"].">Annuler la commande</button>";
                                                echo "<p>".$errorDate."</p>";
                                            echo "</div>";
                                        echo "</form>";
                                        echo'<div id="errorMessage">'; // message d'erreur en fonction du problème lors de la validation de la réservation
                                            echo'<p> '.$errorHeure.' </p>';
                                            echo'<p> '.$errorWeekend.' </p>';
                                            echo'<p> '.$errorDateSupp.' </p>';
                                            echo'<p> '.$ErrorValue.' </p>';
                                        echo'</div>';
                                    }
                                ?>
                            </div>
                            <?php
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            include('./Templates/footer.php');
        ?>   

    </body>
</html>