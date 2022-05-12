<?php
    session_start();
    include('../Connexion/connexion.php');
    $co = connexionBdd();

    $date = new DateTime(); // objet date qui utilise la date et l'heure courante
    $dt= $date->format('Y-m-d'); 
    
    $username = $_SESSION["username"];
    $errorHeure = "";
    $errorHeureChoix = "";
    $errorDate = "";
    $errorWeekend = "";
    $errorDateSupp = "";
    $ErrorValue = "";
    $sandwich = $dessert = $boisson = $reservationHour = "";
    
    $isSuccess = false;
    $heureLimite = "09:30";
    $timestampHeureLimite = strtotime($heureLimite);
    $heureL=date('H-i', $timestampHeureLimite);    


    if(isset($_POST['submit']))
    {
        $hour = new DateTime(); //créer un objet qui contient la date et l'heure du serveur au moment où l'utilisateur valide la réservation
        $h = $hour->format('H:i'); // stock l'objet dans une variable sous la forme heure et minute
        $timestampHeureactuel = strtotime($h); //conversion de l'heure du serveur en timestamp
        $HeureActuel = date('H-i', $timestampHeureactuel); //conversion du timestamp en format date

        include('../Formulaire_sandwich/verif/checkEmpty.php'); // fichier de vérification qu'aucun champ n'est vide
        if($isSuccessEmpty == true)
        {
            $sandwich = $_POST['sandwich']; //récupère le chhoix du sandwich
            $dessert = $_POST['dessert'];//récupère le choix du dessert
            $boisson =  $_POST['boisson'];//récupère le choix de la boisson
            $reservationHour = $_POST['heure']; //récupère l'heure de réservation
            
        }    
        $chips = $_POST['chips'];//récupère le choix des chips
        $reservationDate = $_POST['date']; //récupère la date de réservation
        $timestampJour = strtotime($reservationDate); //conversion de la date sous format timestamp unix
        include('../Formulaire_sandwich/verif/checkValue.php');//fichier de vérification de la value du sandwich.
        $formatJour="w"; // changement du format de la date en jour de la semaine de 0 à 6
        $jourInterdit = date($formatJour, $timestampJour); // Création d'une variable qui récupère le numéro de jour pour ensuite le comparer
        
        include('../Formulaire_sandwich/verif/checkWeekEnd.php'); // fichier vérification d'interdictio de commande en week end
        include('../Formulaire_sandwich/verif/checkDate.php'); // fichier d'interdiction de commande à une date antérieur et de commande à + d'une semaine d'intervalle
        include('../Formulaire_sandwich/verif/checkHeure.php'); //fichier verification d'interdiction de commande pour le jour même après 9h30
        include('../Formulaire_sandwich/verif/checkDispo.php'); //fichier de vérification qu'un éléments n'est pas indisponible 
        include('../Formulaire_sandwich/verif/success.php'); // fichier de vérification que toutes les vérifications sont respectés
        
        if($isSuccess == true) // si toutes les vérifications sont bonnes
        {
            include('../Formulaire_sandwich/session/sessionInit.php');
            header('Location: ../Formulaire_sandwich/validation/validation.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de sandwich</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> <!--CDN bootstrap librarie-->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> <!--CDN JQuery-->   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!--CDN JS poour bootstrap-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Pacifico&display=swap" rel="stylesheet">
    <link href="reservationSandwich.css" rel="stylesheet">
</head>
<body>
    <?php include("../Templates/header.php");?>
    <section id="Reservation">
        <div id="header">
            <h1><img src="../Images/resa.svg" alt="iconeRepas" class="resa"> Réservez votre repas <img src="../image/resa.svg" alt="iconeRepas" class="resa"></h1>
            <span id="blue_divider"></span>
        </div>
        <div id="ResExt">
            <form method ="post">
                <div id="listederoulante">
                    <?php   
                        $query = $co->prepare('SELECT * FROM sandwich'); //selectionne tous les éléments de la table sandwich
                        $query->execute();
                        echo   '<div class="listeChoix">
                                <img src="../Images/sandwichLogo2.svg" alt="sandwich">
                                <Select name="sandwich">
                                    <option value="'.$sandwich.'" disabled selected>Choisir un sandwich</option>';
                                while($result = $query->fetch()) // stock dans un tableau le résultat 
                                {
                                    $temp = $result[2]; // stock la disponibilité dans une variable (1 = dispo / 0 = non dispo)
                                    if($temp < 1) // si la dispo est inférieur à 1, la case n'est pas possible à sélectionner
                                    {
                                        echo '<option value="'.$result[0].'" class="nonDispo" disabled>'.$result[1] .'</option>';
                                    }
                                    else{ // sinon la case est possible à sélectionner
                                        echo'<option value="'.$result[0].'">'.$result[1] .'</option>';
                                    }
                                }
                                echo '</Select>
                                <small class="error"> '.$errorSandwich.' </small>
                                <small class="error"> '.$errorDispoSandwich.' </small>
                            </div>';
                    ?>
                    <?php   
                        $query = $co->prepare('SELECT * FROM boisson');
                        $query->execute();
                    echo    '<div class="listeChoix">
                                <img src="../Images/canette.svg" alt="boisson">
                                <Select name="boisson">
                                    <option value="'.$boisson.'" disabled selected>Choisir une boisson</option>';
                                while($result = $query->fetch())
                                {
                                    $temp = $result[2];
                                    if($temp < 1)
                                    {
                                        echo '<option value="'.$result[0].'" class="nonDispo" disabled>'.$result[1] .'</option>';
                                    }
                                    else{
                                        echo'<option value="'.$result[0].'">'.$result[1] .'</option>';
                                    }
                                }
                                echo '</Select>
                                <small class="error"> '.$errorBoisson.' </small>
                                <small class="error"> '.$errorDispoBoisson.' </small>
                            </div>';
                    ?>
                    <?php   
                        $query = $co->prepare('SELECT * FROM dessert');
                        $query->execute();
                    echo    '<div class="listeChoix">
                                <img src="../Images/cookie.svg" alt="dessert">
                                <Select name="dessert">
                                    <option value="'.$dessert.'" disabled selected>Choisir un dessert</option>';
                                while($result = $query->fetch())
                                {
                                    $temp = $result[2];
                                    if($temp < 1)
                                    {
                                        echo '<option value="'.$result[0].'" class="nonDispo" disabled>'.$result[1] .'</option>';
                                    }
                                    else{
                                        echo'<option value="'.$result[0].'">'.$result[1] .'</option>';
                                    }
                                }                                
                                echo '</Select>
                                <small class="error"> '.$errorDessert.' </small>
                                <small class="error"> '.$errorDispoDessert.' </small>
                            </div>';
                    ?>
                </div>
                <div id="choixChips">        
                    <h4>Voulez-vous des chips ? <img src="../Images/chips.png" alt="chips"></h4>
                    <div id="radiobtn">
                        <div class="radio">
                            <label for="oui">Oui</label>
                            <input type="radio" value="1" name="chips">
                        </div>
                        <div class="radio">
                            <label for="non">Non</label>
                            <input type="radio" value="0" name="chips" checked>
                        </div>
                    </div>
                </div>
                <div id="dateHeure">
                    <h4>Choisissez la date et l'heure de livraison : </h4>
                    <?php
                        echo'<input type="date" name="date" value="'.$dt.'">';
                    ?>
                    <select name="heure">
                        <option value="<?php $heure; ?>" name="desac" disabled selected> Heure de réservation </option>
                        <option value="11:40"> 11:40 </option>
                        <option value="12:35"> 12:35 </option>
                    </select>
                    <small class="error" id ="errorHeureChoix"> <?php echo $errorHeureChoix; ?> </small>
                </div>
                <?php
                    echo'<div id="errorMessage">'; // message d'erreur en fonction du problème lors de la validation de la réservation
                        echo'<p> '.$errorDate.' </p>';
                        echo'<p> '.$errorHeure.' </p>';
                        echo'<p> '.$errorWeekend.' </p>';
                        echo'<p> '.$errorDateSupp.' </p>';
                        echo'<p> '.$ErrorValue.' </p>';
                    echo'</div>';
                ?>
                <div id="btnSubmit">
                    <button type="submit" name="submit" id="submit" class="noselect">Réserver</button>
                </div>
            </form>
        </div>
        <button type="button" class="btn btn-primary" id="modalButton" data-bs-toggle="modal" data-bs-target="#produitsIndispo">
            Produits non disponibles
        </button>

        <!-- Modal produit indisponible -->
        <div class="modal fade" id="produitsIndispo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Produits indisponible</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                            $query = $co->prepare('SELECT * FROM sandwich where dispo_sandwich = 0');
                            $query->execute();
                            echo '<h6 class="modalProduitsIndispo"> Les sandwichs indisponibles sont:</h6>';
                            while($result = $query->fetch())
                            {
                                echo '<p class="ingreIndispo"> - '.$result[1].'<br></p>';
                            }
                            $query = $co->prepare('SELECT * FROM boisson where dispo_boisson = 0');
                            $query->execute();
                            echo '<h6 class="modalProduitsIndispo"> Les boissons indisponibles sont:</h6>';
                            while($result = $query->fetch())
                            {
                                echo '<p class="ingreIndispo"> - '.$result[1].'<br></p>';
                            }
                            $query = $co->prepare('SELECT * FROM dessert where dispo_dessert = 0');
                            $query->execute();
                            echo '<h6 class="modalProduitsIndispo"> Les desserts indisponibles sont:</h6>';
                            while($result = $query->fetch())
                            {
                                echo '<p class="ingreIndispo"> - '.$result[1].'<br></p>';
                            }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Compris !</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>