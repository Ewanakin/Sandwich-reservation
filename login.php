<!DOCTYPE html>
<html lang="Fr_fr">
<head>
    <link rel="stylesheet" href="style.css" />
    <title></title>
</head>
<body>
<?php
session_start();
require('./Connexion/connexion.php');
if (isset($_POST['submitUser'])) {
    $co = connexionBdd();
    $email = $_POST["email"];
    $password = $_POST["password"];
    $userToTest = $co->prepare("SELECT * FROM utilisateur WHERE email_user = ? and password_user = ?");
    $userToTest->execute(array($email, $password));
    $resUser = $userToTest->fetch();
    $idUser = $resUser["id_user"];
    $nbUser = $userToTest->rowCount();
    if($nbUser == 1)
    {
        $_SESSION["username"] = $email;
        $_SESSION["id_user"] = $idUser;
        header("Location: ./index.php");
    }
    else
    {
        $message = "votre email ou mot de passe est invalid";
    }
}

?>
    <form class="box" action="" method="post" name="login">
        <h1 class="box-title">Connexion</h1>
        <p style="font-size: 22px; color: white">Email</p>
        <label>
            <input type="text" class="box-input" name="email" placeholder="Email">
        </label>
        <p style="font-size: 22px; color: white">Mot de Passe</p>
        <label>
            <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        </label>

        <input type="submit" name="submitUser" value="Confirmer" class="box-button">

        <p class="box-register">Vous êtes nouveau ici?
            <a href="register.php">S'inscrire</a>
        </p>
        <p class="box-register">retourner au menu
            <a href="./index.php">cliquez ici</a>
        </p>
        <?php if (! empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
    </form>
</body>
</html>
