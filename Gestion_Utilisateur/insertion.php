<?php
    require("../Connexion/connexion.php");
    $co = connexionBdd();
    session_start();
    $username = $_SESSION["username"];
    $role = $email = $pass = $nom = $prenom = $activeUser = "";
    $errorRole = $errorEmail = $errorPass = $errorNom = $errorPrenom = "";

    if(isset($_POST['submit']))
    {
        include('verifInsertionUtilisateur/checkEmptyUtilisateur.php');
        if($isSuccessEmpty == true) // seulement is les champs ne sont pas vides
        {
            $role = $_POST['roleUser'];
            $email = $_POST['email'];
            $pass = password_hash($_POST['pass'], PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
            $nom = $_POST['nomUser'];
            $prenom = $_POST['prenomUser'];
            $activeUser = $_POST['activeUser'];
            //requete pour insert un utilisateur
            $insertUser = $co->prepare("INSERT INTO utilisateur (role_user, email_user, password_user, nom_user, prenom_user, active_user) VALUES(?,?,?,?,?,?)");
            $insertUser->execute(array($role,$email,$pass,$nom,$prenom,$activeUser));
            header("Location: admin.php");
            exit;
        }
    }
    if(isset($_POST["annuler"]))
    {
        header("Location: admin.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertion utilisateur admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> <!--CDN JQuery-->   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Pacifico&display=swap" rel="stylesheet">
    <link href="insertion.css" rel="stylesheet">
</head>
<body>
    <?php include("../Templates/header.php");?>
    <section id="insertUserAdmin">
        <form method="post" id="insertForm">
            <select name="roleUser" id="roleUser">
                <option value="" disabled selected>Choisir le rôle de l'utilisateur</option> <!--liste déroulante contenant le choix du statut de l'utilisateur-->
                <option value="a">Administrateur</option>
                <option value="b">Élève</option>
            </select>
            <small class="errorMsg"><?php echo $errorRole ?></small>
            <!--Input pour rentrer les différentes informations de l'utilisateur-->
            <label for="email">Email de l'utilisateur</label> 
            <input type="mail" name="email">
            <small class="errorMsg"><?php echo $errorEmail ?></small>
            <label for="pass">Mot de passe de l'utilisateur</label>
            <input type="password" name="pass">
            <small class="errorMsg"><?php echo $errorPass ?></small>
            <label for="nomUser">Nom de l'utilisateur</label>
            <input type="text" name="nomUser">
            <small class="errorMsg"><?php echo $errorNom ?></small>
            <label for="prenomUser">prénom de l'utilisateur</label>
            <input type="text" name="prenomUser">
            <small class="errorMsg"><?php echo $errorPrenom ?></small>
            <label for="activeUser">L'utilisateur est-il activé ou désactivé</label>
            <!--liste déroulante qui permet à l'admin de décider si ce compte sera actif ou non-->
            <select name="activeUser" id="activeUser">
                <option value="1">Activé</option>
                <option value="0">Désactivé</option>
            </select>
            <button type="submit" name="submit">Créer l'utilisateur</button>
            <button type="submit" name="annuler">Annuler la création d'utilisateur</button>
        </form>
    </section>
</body>
</html>