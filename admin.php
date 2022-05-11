<?php
    //appel du fichier de connexion à la BDD   
    require "connexion.php";
    //$co prend la valeur de retour de la fonction connexionBdd()
    $co = connexionBdd();
    //création de la session
    session_start();
    if(isset($_POST["btnSupprUti"]))
    {
        // On définit la variable de session username avec la valeur saisie par l'utilisateur
        $_SESSION['id_user'] = $_POST["btnSupprUti"];
        $_SESSION['username'] = "test";
        // On lance la page index.php à la place de la page actuelle
        header("Location: Gestion_Utilisateur/deleteUser.php");
    }
    if(isset($_POST["btnModifUti"]))
    {
        // On définit la variable de session username avec la valeur saisie par l'utilisateur
        $_SESSION['id_user'] = $_POST["btnModifUti"];
        $_SESSION['username'] = "test";
        // On lance la page index.php à la place de la page actuelle
        header("Location: Gestion_Utilisateur/modifUser.php");
    }
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
        <!--affichage de la navbar(faire un include)-->
        <div class="navbar">
            <a class="active" href="./index.php">Réservation <br> Sandwich</a>
            <a style="float: right" href="#news">Se déconnecter</a>
        </div>
        <!--redirection vers la création d'un utilisateur-->
        <a href="Gestion_Utilisateur/insertion.php">Ajouter un nouvel utilisateur</a>
        <div id="table-scroll" class="table-scroll" style='max-width:500px;margin-top: 200px;'>
            <div class="table-wrap">
                <table class="main-table">
                    <thead>
                        <tr>
                            <th scope="col">Id Utilisateur</th>
                            <th scope="col">Prenom utilisateur</th>
                            <th scope="col">Nom utilisateur</th>
                            <th scope="col">active</th>
                            <th scope="col">Modifier utilisateur</th>
                            <th scope="col">Supprimer utilisateur</th>
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
                                    echo "<form method='post' name='formUtilisateur' action=''>";
                                        //affichage de l'ID de l'utilisateur
                                        echo "<td>".$utilisateur["id_user"]."</td>";
                                        //affichage du prenom de l'utilisateur
                                        echo "<td>".$utilisateur["prenom_user"]."</td>";
                                        //affichage du nom de l'utilisateur 
                                        echo "<td>".$utilisateur["nom_user"]."</td>";
                                        //affichage du status de l'utilisateur
                                        echo "<td>".$utilisateur["active_user"]."</td>";
                                        //bou_ton pour modifier les informations d'un utilisateur
                                        echo "<td><button type='submit' value=".$utilisateur["id_user"]." name='btnModifUti'>Modifier</button></td>";
                                        //bouton pour supprimer un utilisateur
                                        echo "<td><button type='submit' value=".$utilisateur["id_user"]." name='btnSupprUti'>Supprimer</button></td>";
                                    echo "</form>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--affichage du footer-->
        <footer>
            <p>Footer Saint-Vincent</p>
        </footer>
    </body>
</html>