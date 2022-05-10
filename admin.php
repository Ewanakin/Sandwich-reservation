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
        <title>Page gestion des utilisateurs</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        
        <div class="navbar">
            <a class="active" href="./index.php">Réservation <br> Sandwich</a>
            <a style="float: right" href="#news">Se déconnecter</a>
        </div>

        <div id="table-scroll" class="table-scroll" style='max-width:500px;margin-top: 200px;'>
            <div class="table-wrap">
                <table class="main-table">
                    <thead>
                    <tr>
                        <th scope="col">Id Utilisateur</th>
                        <th scope="col">Prenom utilisateur</th>
                        <th scope="col">Nom utilisateur</th>
                        <th scope="col">supprimer utilisateur</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            //requete pour afficher 
                            $reqUser = $co->prepare("SELECT * FROM utilisateur WHERE role_user = 'b'");
                            $reqUser->execute();
                            while($utilisateur = $reqUser->fetch())
                            {
                                echo "<tr>";
                                    echo "<form method='post' name='formUtilisateur' action='deleteUser.php'>";
                                        //affichage de l'ID de l'utilisateur
                                        echo "<td>".$utilisateur["id_user"]."</td>";
                                        //affichage du prenom de l'utilisateur
                                        echo "<td>".$utilisateur["prenom_user"]."</td>";
                                        //affichage du nom de l'utilisateur 
                                        echo "<td>".$utilisateur["nom_user"]."</td>";
                                        //bouton pour supprimer un utilisateur
                                        echo "<td><button type='submit' value=".$utilisateur["id_user"]." name='btnSupprUti'>supprimer</button></td>";
                                    echo "</form>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <footer>
            <p>Footer Saint-Vincent</p>
        </footer>
    </body>
</html>