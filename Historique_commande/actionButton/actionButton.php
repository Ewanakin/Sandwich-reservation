<?php
    $jourInterdit = $jourInterdit = $reservationDate = $reservationDate = $reservationDate ="";
    //modification de la date de livraison de la commande
    if(isset($_POST["btnModifLivraison"]))
    {
        if(empty($_POST["heure"]))
        {
            $errorHeureChoix = "merci de ne pas laisser le champ vide";
        }
        else
        {
            $reservationDate = $_POST['date']; //récupère la date de réservation
            $timestampJour = strtotime($reservationDate); //conversion de la date sous format timestamp unix
            $formatJour="w"; // changement du format de la date en jour de la semaine de 0 à 6
            $jourInterdit = date($formatJour, $timestampJour); // Création d'une variable qui récupère le numéro de jour pour ensuite le comparer
            $datetime = $_POST["date"] . ' ' . trim(substr($_POST["heure"],0)); //créer une variable avec l'heure et la date 
            $timeStampDateTime = strtotime($datetime); //conversion en timestamp
            $full_date_time = date('Y-m-d-H-i', $timeStampDateTime); //conversion du timestamp en format date et heure complete
            include('./Historique_commande/verif/checkWeekEnd.php'); // fichier vérification d'interdictio de commande en week end
            include('./Historique_commande/verif/checkDate.php'); // fichier d'interdiction de commande à une date antérieur et de commande à + d'une semaine d'intervalle  
            include('./Historique_commande/verif/checkHeure.php'); //fichier verification d'interdiction de commande pour le jour même après 9h30
            if($isSuccessDateSupp == true and $isSuccessHeure == true and $isSuccessWeekEnd == true and $isSuccessDateAnt == true)
            {
                $reqUpdateCommande = $co->prepare("UPDATE commande SET date_heure_livraison_com = ? WHERE id_com = ? ");
                $reqUpdateCommande->execute(array($full_date_time,$_POST["btnModifLivraison"]));
            }
        }
    }
    //bouton supression
    if(isset($_POST["btnSupprLivraison"]))
    {
        $supprCom = $co->prepare("UPDATE commande SET annule_com = ? WHERE id_com = ?");
        $supprCom->execute(array(1,$_POST["btnSupprLivraison"]));
    }
    //modification du filtre des commandes
    if(isset($_POST["updateFilter"]))
    {
        if($_POST["startFilter"] > $_POST["endFilter"])
        {
            $errorFiltre = "merci de choisir une date de début plus petite que celle de fin";
        }
        else
        {
            $updateFilter = $co->prepare("UPDATE historique SET dateDebut_hist = ? , dateFin_hist = ? WHERE fk_user_id = ?");
            $updateFilter->execute(array($_POST["startFilter"],$_POST["endFilter"],$uti["id_user"]));
        }
    }
    //ajout d'un nouveau filtre par l'utilisateur
    if(isset($_POST["btnAjoutFiltre"]))
    {
        //test de si un des champs de saisie est vide
        if(empty($_POST["startFilter"] and $_POST["endFilter"]))
        {
            $errorSaisie = "les champs doivent etre séléctionnés";
        }
        //si les champs ne sont pas vides test de la saisie
        else
        {
            //si le filtre de départ séléctionné est plus grand que celui de fin alors erreur
            if($_POST["startFilter"] > $_POST["endFilter"])
            {
                $errorFiltre = "merci de choisir une date de début plus petite que celle de fin";
            }
            //si la saisie est ok alors insert de la date
            else
            {
                $reqtest = $co->prepare("INSERT INTO historique(dateDebut_hist,dateFin_hist,fk_user_id) VALUES(?,?,?)");
                $reqtest->execute(array($_POST["startFilter"],$_POST["endFilter"],$uti["id_user"]));
            }
        }
    }