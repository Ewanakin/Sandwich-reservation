<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Sandwicherie</title>
        <link rel="preconnect" href="https://fonts.googleapis.com/%22%3E">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./Templates/header.css">
    </head>
    <body>

        <header>
                <?php
                    $reqUser = $co->prepare("SELECT * FROM utilisateur WHERE email_user = ?");
                    $reqUser->execute(array($username));
                    $rowUser = $reqUser->fetch();
                    //si un utilisateur est bien connecté
                    if($username != "")
                    {
                        //si l'utilisateur connecté est un administrateur
                        if($rowUser["role_user"] == "a")
                        {
                            echo "<ul>";
                                echo "<li><a href='./index.php'>Reservation Sandwich</a></li>";
                                echo "<li><a href='./admin.php'>Gestion des utilisateurs</a></li>";
                                echo "<li><a href='./menuManager.php'>Modification Accueil</a></li>";
                                echo "<li><a href='./Connexion/deconnexion.php'>Deconnexion</a></li>";
                            echo "</ul>";
                        }
                        //si l'utilisateur connecté est un eleve
                        else
                        {   
                            echo "<ul>";
                                echo "<li><a href='./index.php'>Reservation Sandwich</a></li>";
                                echo "<li><a href='./reservationSandwich.php'>passer une commande</a></li>";
                                echo "<li><a href='./Historique_commande/hist_com.php'>historique des commandes</a></li>";
                                echo "<li><a href='./Connexion/deconnexion.php'>Deconnexion</a></li>";
                            echo "</ul>";
                        }
                    }
                    //si aucun utilisateur n'est connecté
                    else
                    {
                        echo "<ul>";
                            echo "<li><a href='./index.php'>Reservation Sandwich</a></li>";
                            echo "<li><a href='./register.php'>S'inscrire</a></li>";
                            echo "<li><a href='./login.php'>Se connecter</a></li>";
                        echo "</ul>";
                    }
                ?>
        </header>
    </body>
</html>