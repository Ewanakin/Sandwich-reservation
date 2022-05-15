<!DOCTYPE html>
<html lang="Fr_fr">
<head>
    <link rel="stylesheet" href="style.css" />
    <title></title>
</head>
<body>
<?php
$idUser = "";
session_start();
require('./Connexion/connexion.php');
if (isset($_POST['submitUser'])) {
    $co = connexionBdd();
    $email = $_POST["email"];
    $password = $_POST["password"];
    if(empty($email) or empty($password))
    {
        $message = "merci de remplir les champs";
    }
    else
    {
        $stmt = $co->prepare("SELECT password_user FROM utilisateur WHERE email_user = ?"); 
        // on execute la requete
        $stmt->execute(array($email));
        // on va chercher récuperer les resultats
        $user = $stmt->fetch();
        $nbUSer = $stmt->rowCount();
        if($nbUSer == 1)
        {
            if(password_verify($password, $user['password_user']))
            { 
                $_SESSION["username"] = $email;
                $_SESSION["id_user"] = $password;
                header("Location: ./index.php");
            }else{
                // Si la requête ne retourne rien, alors l'utilisateur ou mdp n'existe pas dans la BD, on lui
                // affiche un message d'erreur
                $message = "email ou mot de passe incorrect.";
            }
        }
        else
        {
            $message = "email ou mot de passe incorrect.";
        }
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
