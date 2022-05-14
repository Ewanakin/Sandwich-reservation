<!DOCTYPE html>
<html lang="Fr_fr">
<head>
    <link rel="stylesheet" href="style.css" />
    <title></title>
</head>
<body>
<?php

if (isset($_POST['credentials'])) {
    require('./forms/authLogin.php');

    if (true === authenticateUser($_POST['credentials']['email'] ,$_POST['credentials']['password'])) {

        if ($_SESSION['user']['role_user'] === 'a'){
            header('location: index.php');
        }
        else {
            header('location: index.php');
        }
    } else {
        return "Email ou mot de passe incorrect";
    }

}

?>
<form class="box" action="" method="post" name="login">
    <h1 class="box-title">Connexion</h1>
    <p style="font-size: 22px; color: white">Email</p>
    <label>
        <input type="text" class="box-input" name="credentials[email]" placeholder="Email">
    </label>
    <p style="font-size: 22px; color: white">Mot de Passe</p>
    <label>
        <input type="password" class="box-input" name="credentials[password]" placeholder="Mot de passe">
    </label>

    <input type="submit" value="Confirmer" class="box-button">

    <p class="box-register">Vous êtes nouveau ici?
        <a href="register.php">S'inscrire</a>
    </p>
    <?php if (! empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</form>
</body>
</html>
