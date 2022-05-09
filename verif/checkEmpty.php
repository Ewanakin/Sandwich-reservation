<?php
    $isSuccessEmpty = false;
    $errorSandwich=$errorBoisson=$errorDessert=$errorDispoSandwich=$errorDispoBoisson=$errorDispoDessert=$errorHeureChoix = "";
    //vérification des champs, si les champs ne sont pas sélectionnés -> impossibilité de réserver
    if(empty($_POST['sandwich']))
    {  
        $errorSandwich = "Choisissez un sandwich. ";
        $isSuccessEmpty = false;
    }
    else{
        $isSuccessEmpty = true;
    }

    if(empty($_POST['boisson']))
    {  
        $errorBoisson = "Choisissez une boisson. ";
        $isSuccessEmpty = false;
    }
    else{
        $isSuccessEmpty = true;
    }

    if(empty($_POST['dessert']))
    {  
        $errorDessert = "Choisissez un dessert. ";
        $isSuccessEmpty = false;
    }
    else{
        $isSuccessEmpty = true;
    }

    if(empty($_POST['heure']))
    {
        $errorHeureChoix = "Veuillez choisir une heure de livraison. ";
        $isSuccessEmpty = false;
    }
    else{
        $isSuccessEmpty = true;
    }

?>