<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
require('./Connexion/connexion.php');
$co = connexionBdd();
session_start();
if(isset($_POST['createUser'])) 
{
    $userToTest = $co->prepare("INSERT INTO utilisateur(role_user, email_user, password_user, nom_user, prenom_user, active_user) VALUES('a', ?,?,?,?, 1) ");
    $userToTest->execute(array($_POST["email"], password_hash($_POST["password"], PASSWORD_ARGON2I), $_POST['nom'], $_POST['prenom']));
    $selectUser = $co->prepare("SELECT * FROM utilisateur WHERE email_user = ?");
    $selectUser->execute(array($_POST["email"]));
    $resUser = $selectUser->fetch();
    $_SESSION["username"] = $_POST["email"];
    $_SESSION["id_user"] = $resUser["id_user"];
    header("Location: ./index.php");

}
?>
    <form class="box" action="" method="post">
        <h1 class="box-title" style="margin-top: -86px; margin-bottom: 0px">S'inscrire</h1>
        <p style="font-size: 22px; color: white;margin-top: 0px;">Nom</p>
        <input type="text" class="box-input" name="nom" placeholder="Nom d'utilisateur" required />

        <p style="font-size: 22px; color: white;margin-top: 0px;">Prénom</p>
        <input type="text" class="box-input" name="prenom" placeholder="Prenom d'utilisateur" required />

        <p style="font-size: 22px; color: white;margin-top: 0px;">Email</p>
        <input type="text" class="box-input" name="email" placeholder="Email" required />

        <p style="font-size: 22px; color: white;margin-top: 0px;">Mot de passe</p>
        <input type="password" class="box-input" name="password"  placeholder="Mot de passe" required />

        <input name="createUser"type="submit" value="S'inscrire" class="box-button" style="margin-top: 10px"/>

        <p class="box-register">Déjà inscrit?
            <a href="login.php">Connectez-vous ici</a></p>
        <p class="box-register">retourner au menu
        <a href="./index.php">cliquez ici</a></p>
    </form>
<?php 
    include('Templates/footer.php'); 
?>
</body>
</html>
