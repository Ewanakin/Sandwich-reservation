<?php
    //modification de la date de livraison de la commande
    if(isset($_POST["btnModifLivraison"]))
    {
        $datetime = $_POST["date"] . ' ' . trim(substr($_POST["heure"],0)); //créer une variable avec l'heure et la date 
        $timeStampDateTime = strtotime($datetime); //conversion en timestamp
        $full_date_time = date('Y-m-d-H-i', $timeStampDateTime); //conversion du timestamp en format date et heure complete
        $reqUpdateCommande = $co->prepare("UPDATE commande SET date_heure_livraison_com = ? WHERE id_com = ? ");
        $reqUpdateCommande->execute(array($full_date_time,$_POST["btnModifLivraison"]));

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