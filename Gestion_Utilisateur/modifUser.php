<?php
        //appel du fichier de connexion à la BDD   
        require "../Connexion/connexion.php";
        //$co prend la valeur de retour de la fonction connexionBdd()
        $co = connexionBdd();
        //création de la session
        session_start();
        $idUser = $_SESSION['id_user'];
        if(isset($_POST["modifUser"]))
        {   
            //si le champ password n'est pas remplia lors update des informations sans le mot de passe pour évitter de le changer
            if(empty($_POST["passwordUser"]))
            {
                //requete pour modifier les informations de l'utilisateur
                $modifUser = $co->prepare("UPDATE utilisateur SET email_user = ?, nom_user = ?, prenom_user = ?, active_user = ? WHERE id_user = ?");
                $modifUser->execute(array($_POST["emailUser"],$_POST["nomUser"],$_POST["prenomUser"],$_POST["activeUser"], $idUser));
            }
            // si le champ password est rempli alors modifier les informations avec le mot de passe
            else
            {
                //chiffrement du mot de passe avec argon2i
                $password = password_hash($_POST["passwordUser"], PASSWORD_ARGON2I);
                //requete pour modifier les informations de l'utilisateur
                $modifUser = $co->prepare("UPDATE utilisateur SET email_user = ?, password_user = ?, nom_user = ?, prenom_user = ?, active_user = ? WHERE id_user = ?");
                $modifUser->execute(array($_POST["emailUser"],$password,$_POST["nomUser"],$_POST["prenomUser"],$_POST["activeUser"], $idUser));
            }
            header("Location: admin.php");
            exit;
        }
        if(isset($_POST["annulModif"]))
        {
            header("Location: admin.php");
            exit;
        }
        
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../admin.css" rel="stylesheet">
        <title>Page Modification utilisateur</title>
    </head>
    <body>
        <?php include("../Templates/header.php");?>
        <?php
            echo "<div id='table-scroll' class='table-scroll' style='max-width:500px;margin-top: 200px;'>";
            echo " <div class='table-wrap'>";
                echo "<h3>Les informations de l'utilisateur</h3>";
                echo "<table class='main-table'>";
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th scope='col'>Id</th>";
                            echo "<th scope='col'>Email</th>";
                            echo "<th scope='col'>Password</th>";
                            echo "<th scope='col'>Nom</th>";
                            echo "<th scope='col'>Prenom</th>";
                            echo "<th scope='col'>Active</th>";
                            echo "<th scope='col'>bouton annuler</th>";
                            echo "<th scope='col'>bouton modifier</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                        //requete pour afficher les informations des utilisateurs
                        $reqUtilisateur = $co->prepare("SELECT * FROM utilisateur WHERE id_user = ?");
                        $reqUtilisateur->execute(array($idUser));
                        //boucle while pour afficher la liste des éléments de l'utilisateur
                        while($utilisateur = $reqUtilisateur->fetch())
                        {
                            echo "<tr>";
                                echo "<form method='post'>";
                                    //affichage de l'ID de l'utilisateur
                                    echo "<td>".$utilisateur["id_user"]."</td>";
                                    //affichage de l'email de l'utilisateur
                                    echo "<td><input name='emailUser' value='".$utilisateur["email_user"]."'></td>";
                                    //affichage du mot de passe de l'utilisateur 
                                    echo "<td><input name='passwordUser' placeholder='mot de passe'></td>";
                                    //affichage du nom de l'utilisateur
                                    echo "<td><input name='nomUser' value='".$utilisateur["nom_user"]."'></td>";
                                    //affichage du prénom de l'utilisateur
                                    echo "<td><input name='prenomUser' value='".$utilisateur["prenom_user"]."'></td>";
                                    //affichage du status de l'utilisateur
                                    echo "<td><input name='activeUser' value='".$utilisateur["active_user"]."'></td>";
                                    //bouton annuler les modifications
                                    echo "<td><button type='submit' name='annulModif'>Annuler</button></td>";
                                    //bouton validation des modifications
                                    echo "<td><button type='submit' name='modifUser'>Modifier</button></td>";
                                echo "</form>";
                            echo "</tr>";
                        }
                    echo "</tbody>";
                echo "</table>";
            echo "</div>";
        echo "</div>";
        ?>
    </body>
</html>