<?php
require('./class/connexion.php');
require('./component/navbar.php')
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

</html>

<?php
function changeMenu($path){
    $changeMenu = (new db)->update('UPDATE `accueil` SET `lien_pdf` = ? WHERE `accueil`.`id_accueil` = ?' , [$path, 1]);
}

$homeData = (new db)->fetch('SELECT * FROM accueil');

$pathThumb = './pdf/thumbnails/';
$pathPdf = './pdf/menu/';

$thumbnails = scandir($pathThumb);
$thumbnails = array_diff(scandir($pathThumb), ['.', '..']);

$pdfs = scandir($pathPdf);
$pdfs = array_diff(scandir($pathPdf), ['.', '..']);

foreach ($thumbnails as $thumbnail) {
    $pdfFile = pathinfo($thumbnail)['filename'] . '.pdf';
    ?>

    <div class="menupicker">
        <form method="post" action="changeMenu">
        <img class="menuThumbnail" src="<?= $pathThumb.$thumbnail ?>" >
            <input type="hidden" value="<?= $pathPdf.$pdfFile ?>" name="menu">
            <input type="submit" value="Appliquer ce menu">
        </form>
    </div>

<?php

}