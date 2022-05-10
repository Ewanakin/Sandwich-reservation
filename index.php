<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
            <input type='text' name="pseudo">
            <input type='text' name="pswd">
            <input type="submit" name="btnSubmit">
    </form>
    <?php
        session_start();
        if(isset($_POST["btnSubmit"]))
        {
            // On définit la variable de session username avec la valeur saisie par l'utilisateur
            $_SESSION['username'] = $_POST["pseudo"];
            // On lance la page index.php à la place de la page actuelle
            header("Location: Historique_commande/historique_commande.php");
        }
    ?>
</body>
</html>