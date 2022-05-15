<?php
require('./Connexion/connexion.php');
$co = connexionBdd();

$changeMenu = $co->prepare('UPDATE `accueil` SET `lien_pdf` = ? WHERE `accueil`.`id_accueil` = ?');
$changeMenu->execute(array($_POST['menu'], 1));
header('location: ./menuManager.php');
