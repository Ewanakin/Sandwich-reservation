<?php
    require("../Connexion/connexion.php");
    $co = connexionBdd();
    session_start();
    $_SESSION["username"] = "test";
    $_SESSION["role_user"] = "a";
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Sandwicherie</title>
        <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="header.css">
    </head>
    <body>

        <header>
                <?php
                    //si l'utilisateur connecté est un administrateur
                    if($_SESSION["username"] != "")
                    {
                        if($_SESSION["role_user"] == "a")
                        {
                            echo "<ul>";
                                echo "<li><a href=''>Reservation Sandwich</a></li>";
                                echo "<li><a href=''>Gestion des utilisateurs</a></li>";
                                echo "<li><a href=''>Modification Accueil</a></li>";
                                echo "<li><a href=''>Deconnexion</a></li>";
                            echo "</ul>";
                        }
                        else
                        {   
                            echo "<ul>";
                                echo "<li><a href=''>Reservation Sandwich</a></li>";
                                echo "<li><a href=''>passer une commande</a></li>";
                                echo "<li><a href=''>historique des commandes</a></li>";
                                echo "<li><a href=''>Deconnexion</a></li>";
                            echo "</ul>";
                        }
                    }
                    //si aucun utilisateur n'est connecté
                    if($_SESSION["username"] == "")
                    {
                        echo "<ul>";
                            echo "<li><a href=''>Reservation Sandwich</a></li>";
                            echo "<li><a href=''>S'inscrire</a></li>";
                            echo "<li><a href=''>Se connecter</a></li>";
                        echo "</ul>";
                    }
                ?>
            </ul>
        </header>


    </body>
</html>