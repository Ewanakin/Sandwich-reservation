<!doctype html>
<html lang="fr">
    <body style="margin: 0;">

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
                                echo "<li style='float: right; padding-right: 100px'><a href='./admin.php'>Gestion des utilisateurs</a></li>";
                                echo "<li style='float: right; padding-right: 20px'><a href='./menuManager.php'>Modification Accueil</a></li>";
                                echo "<li style='float: right; padding-right: 20px'><a href='./Connexion/deconnexion.php'>Deconnexion</a></li>";
                            echo "</ul>";
                        }
                        //si l'utilisateur connecté est un eleve
                        else
                        {   
                            echo "<ul>";
                                echo "<li><a href='./index.php'>Reservation Sandwich</a></li>";
                                echo "<li style='float: right; padding-right: 100px'><a href='./reservationSandwich.php'>passer une commande</a></li>";
                                echo "<li style='float: right; padding-right: 20px'><a href='./Historique_commande.php'>historique des commandes</a></li>";
                                echo "<li style='float: right; padding-right: 20px'><a href='./Connexion/deconnexion.php'>Deconnexion</a></li>";
                            echo "</ul>";
                        }
                    }
                    //si aucun utilisateur n'est connecté
                    else
                    {
                        echo "<ul>";
                            echo "<li><a href='./index.php'>Reservation Sandwich</a></li>";
                            echo "<li style='float: right; padding-right: 100px'><a href='./register.php'>S'inscrire</a></li>";
                            echo "<li style='float: right; padding-right: 20px'><a href='./login.php'>Se connecter</a></li>";
                        echo "</ul>";
                    }
                ?>
        </header>
    </body>
</html>