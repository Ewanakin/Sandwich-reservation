<?php
    require("Connexion/connexion.php");
    $co = connexionBdd();
    $reqUser = $co->prepare("SELECT * FROM utilisateur WHERE email_user = ? AND password_user = ?");
    $reqUser->execute(array("administrateur@wanadoo.fr","password"));
    $row =  $reqUser->fetch();
    $existUser = 1;
    if($existUser == 1)
    {
        echo $row["email_user"];
        echo $row["password_user"];
    }
    if($existUser == 0)
    {
        
    }
?>