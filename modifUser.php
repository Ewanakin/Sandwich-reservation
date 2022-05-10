<?php
        //appel du fichier de connexion à la BDD   
        require "connexion.php";
        //$co prend la valeur de retour de la fonction connexionBdd()
        $co = connexionBdd();
        //création de la session
        session_start();
        $idUser = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="admin.css" rel="stylesheet">
        <title>Page Modification utilisateur</title>
    </head>
    <body>
        <?php
            $reqUtilisateur = $co->prepare("SELECT * FROM utilisateur WHERE id_user = ?");
            $reqUtilisateur->execute(array($idUser));
            echo "<div id='table-scroll' class='table-scroll' style='max-width:500px;margin-top: 200px;'>";
            echo " <div class='table-wrap'>";
                echo "<h3>Les informations de l'utilisateur</h3>";
                echo "<table class='main-table'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th scope='col'>Id</th>";
                            echo "<th scope='col'>Role</th>";
                            echo "<th scope='col'>Email</th>";
                            echo "<th scope='col'>Password</th>";
                            echo "<th scope='col'>Nom</th>";
                            echo "<th scope='col'>Prenom</th>";
                            echo "<th scope='col'>Active</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    //boucle while pour afficher la liste des éléments de l'utilisateur
                            while($utilisateur = $reqUtilisateur->fetch())
                            {
                                echo "<tr>";
                                    //affichage de l'ID de l'utilisateur
                                    echo "<td>".$utilisateur["id_user"]."</td>";
                                    //affichage du role de l'utilisateur
                                    echo "<td>".$utilisateur["role_user"]."</td>";
                                    //affichage de l'email de l'utilisateur
                                    echo "<td>".$utilisateur["email_user"]."</td>";
                                    //affichage du mot de passe de l'utilisateur 
                                    echo "<td>".$utilisateur["password_user"]."</td>";
                                    //affichage du nom de l'utilisateur
                                    echo "<td>".$utilisateur["nom_user"]."</td>";
                                    //affichage du prénom de l'utilisateur
                                    echo "<td>".$utilisateur["prenom_user"]."</td>";
                                    //affichage du status de l'utilisateur
                                    echo "<td>".$utilisateur["active_user"]."</td>";
                                echo "</tr>";
                            }
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
        echo "</div>";
        ?>
    </body>
</html>