<?php
require("Connexion/connexion.php");
$co = connexionBdd();
session_start();
$username = $_SESSION["username"];
if(isset($_POST["btnSupprUti"]))
{
    // On définit la variable de session username avec la valeur saisie par l'utilisateur
    $_SESSION['id_user'] = $_POST["btnSupprUti"];
    // On lance la page index.php à la place de la page actuelle
    header("Location: ./Gestion_Utilisateur/deleteUser.php");
}
if(isset($_POST["btnModifUti"]))
{
    // On définit la variable de session username avec la valeur saisie par l'utilisateur
    $_SESSION['id_user'] = $_POST["btnModifUti"];
    // On lance la page index.php à la place de la page actuelle
    header("Location: ./Gestion_Utilisateur/modifUser.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page gestion des utilisateurs</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="util.css">
    <!--===============================================================================================-->
</head>
<body>
<?php include "./Templates/header.php"?>
<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <table data-vertable="ver1">
                    <thead>
                    <div class="ajout">
                        <a href="./Gestion_Utilisateur/insertion.php">Ajouter un nouvel utilisateur</a>
                    </div>
                    <tr class="row100 head">
                        <th scope="col">Id Utilisateur</th>
                        <th scope="col">Prenom utilisateur</th>
                        <th scope="col">Nom utilisateur</th>
                        <th scope="col">active</th>
                        <th scope="col">Modifier utilisateur</th>
                        <th scope="col">Supprimer utilisateur</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                        //requete pour afficher
                        $reqUser = $co->prepare("SELECT * FROM utilisateur WHERE role_user = 'b'");
                        $reqUser->execute();
                        while($utilisateur = $reqUser->fetch())
                        {
                            echo "<tr class='row100'>";
                            echo "<form method='post' name='formUtilisateur' action=''>";
                            //affichage de l'ID de l'utilisateur
                            echo "<td class='column100 column1' data-column='column1'>".$utilisateur["id_user"]."</td>";
                            //affichage du prenom de l'utilisateur
                            echo "<td class='column100 column1' data-column='column2'>".$utilisateur["prenom_user"]."</td>";
                            //affichage du nom de l'utilisateur
                            echo "<td class='column100 column1' data-column='column3'>".$utilisateur["nom_user"]."</td>";
                            //affichage du status de l'utilisateur
                            echo "<td class='column100 column1' data-column='column4'>".$utilisateur["active_user"]."</td>";
                            //bou_ton pour modifier les informations d'un utilisateur
                            echo "<td><button type='submit' value=".$utilisateur["id_user"]." name='btnModifUti' class='button' data-column='column5'>Modifier</button></td>";
                            //bouton pour supprimer un utilisateur
                            echo "<td><button type='submit' value=".$utilisateur["id_user"]." name='btnSupprUti' class='button' data-column='column6'>Supprimer</button></td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>