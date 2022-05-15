<?php
    //appel du fichier de connexion à la BDD   
    require "../Connexion/connexion.php";
    //$co prend la valeur de retour de la fonction connexionBdd()
    $co = connexionBdd();
    //création de la session
    session_start();
    $username = $_SESSION["username"];
    $idUser = $_SESSION['id_user'];
    //si bouton annuler l'opération est appuyé
    if(isset($_POST["annuleSuppr"]))
    {
        header("Location: ../admin.php");
        exit;
    }
    //si bouton supprimer l'utilisateur appuyé
    if(isset($_POST["supprUti"]))
    {
        //vérification de si l'utilisateur possède un filtre
        $verifHist = $co->prepare("SELECT * FROM historique WHERE fk_user_id = ?");
        $verifHist->execute(array($idUser));
        $nbHist = $verifHist->rowCount();
        //si il possède un filtre on éfféctue la suppression du filtre
        if($nbHist > 0)
        {
            $deleteHist = $co->prepare("DELETE FROM historique WHERE fk_user_id = ?");
            $deleteHist->execute(array($idUser));
        }
        //execution de la requete pour supprimer un utilisateur
        $reqDeleteUser = $co->prepare("DELETE FROM utilisateur WHERE id_user = ?");
        $reqDeleteUser->execute(array($idUser));
        //retour sur la page admin.php
        header("Location: ../admin.php");
        exit;
    }
    //si bouton désactivé est appuyé
    if(isset($_POST["desacUti"]))
    {
        $desacUser = $co->prepare("UPDATE utilisateur SET active_user = ? WHERE id_user = ?");
        $desacUser->execute(array(0,$idUser));
        header("Location: ../admin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page Suppression Utilisateur</title>
        <link href="admin.css" rel="stylesheet">
    </head>
    <body>
        <?php
            //requete pour afficher les commandes de l'utilisateur
            $reqCommandeUti = $co->prepare("SELECT * FROM commande WHERE fk_user_id = '".$idUser."'");
            $reqCommandeUti->execute();
            $nbCom = $reqCommandeUti->rowCount();
            //jointure pour afficher le sandwich
            $reqSandwich = $co->prepare("SELECT * FROM sandwich INNER JOIN commande ON sandwich.id_sandwich = commande.fk_sandwich_id");
            $reqSandwich->execute();
            $sandwich = $reqSandwich->fetch();
            //jointure pour afficher la boisson
            $reqBoisson = $co->prepare("SELECT * FROM boisson INNER JOIN commande ON boisson.id_boisson = commande.fk_boisson_id");
            $reqBoisson->execute();
            $boisson = $reqBoisson->fetch();
            //jointure pour afficher le dessert
            $reqDessert = $co->prepare("SELECT * FROM dessert INNER JOIN commande ON dessert.id_dessert = commande.fk_boisson_id");
            $reqDessert->execute();
            $dessert = $reqDessert->fetch();
            if($nbCom > 0)
            {
                echo "<h3>Vous ne pouvez pas supprimer cet utilisateur</h3>";
                echo "<h3>Car il possede deja des commandes</h3>";
                echo "<div id='table-scroll' class='table-scroll' style='max-width:500px;margin-top: 200px;'>";
                    echo " <div class='table-wrap'>";
                        echo "<h3>Les commandes de l'utilisateur</h3>";
                        echo "<table class='main-table'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th scope='col'>Id commande</th>";
                                    echo "<th scope='col'>Sandwich</th>";
                                    echo "<th scope='col'>boisson</th>";
                                    echo "<th scope='col'>dessert</th>";
                                    echo "<th scope='col'>chips</th>";
                                    echo "<th scope='col'>date livraison commande</th>";
                                    echo "<th scope='col'>commande annule</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                                    //boucle pour modifier les commandes de l'utilisateur
                                    while($comUti = $reqCommandeUti->fetch())
                                    {
                                        echo "<tr>";
                                            //affichage de l'ID de la commande
                                            echo "<td>".$comUti["id_com"]."</td>";
                                            //affichage du sandwich de la commande
                                            echo "<td>".$sandwich["nom_sandwich"]."</td>";
                                            //affichage de la boisson
                                            echo "<td>".$boisson["nom_boisson"]."</td>";
                                            //affichage du dessert 
                                            echo "<td>".$dessert["nom_dessert"]."</td>";
                                            //affichage du choix de paquet de chips
                                            echo "<td>".$comUti["chips_com"]."</td>";
                                            //affichage de la date de livraison de la commande
                                            echo "<td>".$comUti["date_heure_livraison_com"]."</td>";
                                            //affichage du status de la commande 
                                            echo "<td>".$comUti["annule_com"]."</td>";
                                        echo "</tr>";
                                    }
                            echo "</tbody>";
                        echo "</table>";
                    echo "</div>";
                echo "</div>";
                echo "<h3>Voulez vous désactiver cet utilisateur ?</h3>";
                echo "<form method='post'>";
                    echo "<button type='submit' name='annuleSuppr'>Annuler</button>";
                    echo "<button type='submit' name='desacUti'>Désactiver</button>";
                echo "</form>";
            }
            else
            {
                echo "<h3>Etes vous sur de vouloir supprimer cet Utilisateur ?</h3>";
                echo "<form method='post' name='supprUti'>";
                    echo "<button type='submit' name='annuleSuppr' >Annuler</button>";
                    echo "<button type='submit' name='supprUti'>Supprimer</button>";
                echo "</form>";
            }
        ?>


    </body>
</html>