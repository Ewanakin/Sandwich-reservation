<?php
// Récupération des données de la session
session_start();

// Vérifie si l'utilisateur est connecté, sinon redirection vers la page de connexion
if($_SESSION["role_user"] != "a"){
    header("Location: login.php");
    exit(); 
}
require('./Connexion/connexion.php');
$co = connexionBdd();

$changeMenu = $co->prepare('UPDATE accueil SET lien_pdf = ? WHERE id_accueil = ?');
$changeMenu->execute(array($_POST['menu'], 0));
header('location: ./menuManager.php');
