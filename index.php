<?php
    require("Connexion/connexion.php");
    $co = connexionBdd();
    session_start();
    $username = $_SESSION["username"];
    require('Templates/header.php')
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Sandwicherie</title>
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto&display=swap" rel="stylesheet">
   </head>
<body>

    <?php
    $homeData = $co->prepare("SELECT * FROM accueil");
    $homeData->execute();
    $homeData = $homeData->fetch();
    ?>

<div class="menu">
    <object class="pdfmenu" data="<?= $homeData['lien_pdf'] ?>"/>
<!--    <img src="presentation-restauration-rapide-sandwich-set-de-table-a3.jpg" style="width: 60%; display: inline-block">-->
</div>
<?php
    include('Templates/footer.php');
?>

</body>
</html>