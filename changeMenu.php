<?php
require('./class/connexion.php');

$changeMenu = (new db)->update('UPDATE `accueil` SET `lien_pdf` = ? WHERE `accueil`.`id_accueil` = ?' , [$_POST['menu'], 1]);
header('location: ./menuManager.php');
