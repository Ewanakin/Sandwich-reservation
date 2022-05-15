<?php
    require('./Connexion/connexion.php');
    $co = connexionBdd();
    session_start();
    $username = $_SESSION["username"];
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sandwicherie</title>
        <link rel="stylesheet" href="index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include("./Templates/header.php");?>
    </body>
</html>

    <?php
    function changeMenu($path){
        $changeMenu = $co->prepare('UPDATE `accueil` SET `lien_pdf` = ? WHERE `accueil`.`id_accueil` = ?');
        $changeMenu->ecevute($path,1);
    }
    $homeData = $co->prepare('SELECT * FROM accueil');
    $homeData->execute();

    $pathThumb = './pdf/thumbnails/';
    $pathPdf = './pdf/menu/';

    $thumbnails = scandir($pathThumb);
    $thumbnails = array_diff(scandir($pathThumb), ['.', '..']);

    $pdfs = scandir($pathPdf);
    $pdfs = array_diff(scandir($pathPdf), ['.', '..']);

    foreach ($thumbnails as $thumbnail) 
    {
        $pdfFile = pathinfo($thumbnail)['filename'] . '.pdf';
        ?>
        <div class="menupicker">
            <form method="post" action="./changeMenu.php">
            <img class="menuThumbnail" src="<?= $pathThumb.$thumbnail ?>" >
                <input type="hidden" value="<?= $pathPdf.$pdfFile ?>" name="menu">
                <input type="submit" value="Appliquer ce menu">
            </form>
        </div>     
        <?php 
    }