<?php
//si un utilisateur est bien connecté
if ($_SESSION['user']['id'] != "") { //si l'utilisateur connecté est un administrateur
    if ($_SESSION['user']["role_user"] == "a") { ?>
        <ul>
            <li><a href='../../sandwicherie/index.php'>Reservation Sandwich</a></li>
            <li style="float: right; padding-right: 100px"><a href='./logout.php'>Deconnexion</a></li>
            <li style="float: right; padding-right: 20px"><a href='../Gestion_Utilisateur/admin.php'>Gestion des utilisateurs</a></li>
            <li style="float: right; padding-right: 20px"><a href='./changeMenu.php'>Modification Accueil</a></li>
        </ul>
        <?php
    } else {    //si l'utilisateur connecté est un eleve ?>
        <ul>
            <li><a href='../../sandwicherie/index.php'>Reservation Sandwich</a></li>
            <li style="float: right; padding-right: 100px"><a href='./logout.php'>Deconnexion</a></li>
            <li style="float: right; padding-right: 20px"><a href='../Formulaire_sandwich/reservationSandwich.php'>Passer une commande</a></li>
            <li style="float: right; padding-right: 20px"><a href='../Historique_commande/hist_com.php'>Historique des commandes</a></li>

        </ul>
        <?php
    }
} else { //si aucun utilisateur n'est connecté ?>
    <ul>
        <li><a href='./index.php'>Reservation Sandwich</a></li>
        <li style="float: right; padding-right: 100px"><a href='./register.php'>S'inscrire</a></li>
        <li style="float: right; padding-right: 20px"><a href='./login.php'>Se connecter</a></li>
    </ul>
    <?php
}
?>