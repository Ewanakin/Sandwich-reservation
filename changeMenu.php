<?php
require('./Connexion/connexion.php');
$co = connexionBdd();

$changeMenu = $co->prepare('UPDATE accueil SET lien_pdf = ? WHERE id_accueil = ?');
$changeMenu->execute(array($_POST['menu'], 0));
header('location: ./menuManager.php');
