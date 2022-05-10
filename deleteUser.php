<?php
    //appel du fichier de connexion à la BDD   
    require "connexion.php";
    //$co prend la valeur de retour de la fonction connexionBdd()
    $co = connexionBdd();
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
        <div id="table-scroll" class="table-scroll" style='max-width:500px;margin-top: 200px;'>
            <div class="table-wrap">
                <table class="main-table">
                    <thead>
                    <tr>
                        <th scope="col">Id commande</th>
                        <th scope="col">Sandwich</th>
                        <th scope="col">boisson</th>
                        <th scope="col">dessert</th>
                        <th scope="col">chips</th>
                        <th scope="col">date livraison commande</th>
                        <th scope="col">commande annule</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            //requete pour afficher 
                            $reqCommandeUti = $co->prepare("SELECT * FROM commande WHERE fk_user_id = '".$_POST["btnSupprUti"]."'");
                            $reqCommandeUti->execute();
                            while($comUti = $reqCommandeUti->fetch())
                            {
                                echo "<tr>";
                                    //affichage de l'ID de la commande
                                    echo "<td>".$comUti["id_com"]."</td>";
                                    //affichage du sandwich de la commande
                                    echo "<td>".$comUti["fk_sandwich_id"]."</td>";
                                    //affichage de la boisson
                                    echo "<td>".$comUti["fk_boisson_id"]."</td>";
                                    //affichage du dessert 
                                    echo "<td>".$comUti["fk_dessert_id"]."</td>";
                                    //affichage du choix de paquet de chips
                                    echo "<td>".$comUti["chips_com"]."</td>";
                                    //affichage de la date de livraison de la commande
                                    echo "<td>".$comUti["date_heure_livraison_com"]."</td>";
                                    //affichage du status de la commande 
                                    echo "<td>".$comUti["annule_com"]."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>