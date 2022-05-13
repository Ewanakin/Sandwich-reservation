<?php
    include('../../connexion/connexion.php'); //inclus le fichier de connexion à la BDD
    $co = connexionBdd();
    session_start();
    include('../session/sessionRecup.php'); //inclus le fichier de recupération des variables session
    include('../requete/requeteValid.php'); //inclus le fichier de requete qui selectionne le noms des aliments par leurs id

    
    $datetime = $date . ' ' . trim(substr($heure,0)); //créer une variable avec l'heure et la date 
    $timeStampDateTime = strtotime($datetime); //conversion en timestamp
    $full_date_time = date('Y-m-d-H-i', $timeStampDateTime); //conversion du timestamp en format date et heure complete
    $_SESSION['id_user'] = 1;
    $chipsChoix = "";
    if($chips == 1 ) //insertion des chips en base de données 1 pour oui et 0 pour non, conditions pour afficher oui ou non en fonction de la value
    {
        $chipsChoix = "Oui";
    }
    else
    {
        $chipsChoix = "Non";
    }
    if(isset($_POST['oui']))
    {           include('../verif/checkDoublon.php');
        if($isSuccessDoublon == false)
        {
            // prépare le requete d'insertion dans la BDD
            $query = $co->prepare('INSERT INTO commande(fk_user_id, fk_sandwich_id,	fk_boisson_id, fk_dessert_id, chips_com, date_heure_livraison_com)
            values(:user, :sandwich, :boisson, :dessert, :chips, :date_heure_liv)');
            // remplir tous les paramètres de la requete
            $query->bindParam(':user', $id_user);
            $query->bindParam(':sandwich', $sandwich);
            $query->bindParam(':boisson', $boisson);
            $query->bindParam(':dessert', $dessert);
            $query->bindParam(':chips', $chips);
            // $query->bindParam('timest', $timestampJour);
            $query->bindParam(':date_heure_liv', $full_date_time);
            $query->execute();
            header('Location: ../../index.php'); // redirige vers l'index
        }
        else
        {
            $query = $co->prepare('UPDATE commande SET fk_sandwich_id =:sandwich, fk_boisson_id =:boisson, fk_dessert_id=:dessert, chips_com =:chips, date_heure_livraison_com=:date_heure_liv WHERE id_com =:com');
            $query->bindParam(':sandwich', $sandwich);
            $query->bindParam(':boisson', $boisson);
            $query->bindParam(':dessert', $dessert);
            $query->bindParam(':chips', $chips);
            $query->bindParam(':date_heure_liv', $full_date_time);
            $query->bindParam(':com', $_SESSION['id_com']);
            $query->execute();
            header('Location: ../../index.php'); // redirige vers l'index
        }
    }

    if(isset($_POST['non']))
    {
        include('../session/sessionReinit.php'); //inclus le fichier de réinitialisation des variables session
        header('Location: ../reservationSandwich.php'); // redirige vers le formulaire de commande
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation de réservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> <!--CDN bootstrap librarie-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> <!--CDN JQuery-->   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!--CDN JS poour bootstrap-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Pacifico&display=swap" rel="stylesheet">
    <link href="validation.css" rel="stylesheet">
</head>
<body>
    <div id="bg_image">
        <img src="../Images/bg_valid.jpg" alt="bg">
    </div>
    <section id="validation">
        <div id="validation_cont">
            <h1>Votre menu se compose de :</h1>
            <?php
                echo '<p> choix du sandwich: <span>'.$Nomsandwich[0].'</span></p>';// nom du sandwich choisi
                echo '<p> choix de la boisson: <span>'.$Nomboisson[0].'</span></p>'; // nom de la boisson choisi
                echo '<p> choix du dessert: <span>'.$Nomdessert[0].'</span></p>'; // nom du dessert choisi
                echo '<p> choix des chips: <span>'.$chipsChoix.'</span></p>'; // choix des chips
                echo '<p> date et heure de la réservation: <span>'.$date.' / '.$heure.'</span></p>'; // date et heure format Y-m-d et H-i
            ?>
            <form method="post" id="choixResa">
                <h4>Voulez vous réservez ce menu ?</h4>
                <button type="submit" name="oui" id="btnOui" onClick="alert('Votre commande a bien été envoyé !')">Oui je réserve !</button>
                <button type="submit" name="non" id="btnNon">Non je change d'avis !</button>    
            </form>
        </div>
    </section>
</body>
</html>