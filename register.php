<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php

if (isset($_POST['credentials'])) {
    require('./forms/authRegister.php');
    if (true === registerUser(
            $_POST['credentials']['firstname'],
            $_POST['credentials']['lastname'],
            $_POST['credentials']['email'],
            $_POST['credentials']['password']
        )) {
        if ($_SESSION['user']['role_user'] === 'a'){
            header('location: ./login.php');
        }
        else {
            header('location: ./login.php');
        }
    } else {
        return "Email ou mot de passe incorrect";
    }

}

if (isset($_POST['username'], $_POST['email'], $_POST['password'])){
    if($res){
        echo "<div class='sucess'>
             <h3>Vous êtes inscrit avec succès.</h3>
             <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>
			 </div>";
    }
} else {
    ?>
    <form class="box" action="" method="post">
        <h1 class="box-title" style="margin-top: -86px; margin-bottom: 0px">S'inscrire</h1>
        <p style="font-size: 22px; color: white;margin-top: 0px;">Nom</p>
        <input type="text" class="box-input" name="credentials[lastname]" placeholder="Nom d'utilisateur" required />

        <p style="font-size: 22px; color: white;margin-top: 0px;">Prénom</p>
        <input type="text" class="box-input" name="credentials[firstname]" placeholder="Prenom d'utilisateur" required />

        <p style="font-size: 22px; color: white;margin-top: 0px;">Email</p>
        <input type="text" class="box-input" name="credentials[email]" placeholder="Email" required />

        <p style="font-size: 22px; color: white;margin-top: 0px;">Mot de passe</p>
        <input type="password" class="box-input" name="credentials[password]"  placeholder="Mot de passe" required />

        <input type="submit" value="S'inscrire" class="box-button" style="margin-top: 10px"/>

        <p class="box-register">Déjà inscrit?
            <a href="login.php">Connectez-vous ici</a></p>
        <p class="box-register">retourner au menu
        <a href="./index.php">cliquez ici</a></p>
    </form>
<?php } 
    include('Templates/footer.php'); 
?>
</body>
</html>
