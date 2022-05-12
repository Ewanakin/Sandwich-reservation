<?php
    $isSuccessEmpty=$isSuccessEmptySandwich=$isSuccessEmptyBoisson=$isSuccessEmptyDessert = false;
    $isSuccessEmptyHeure = false;
    $errorSandwich=$errorBoisson=$errorDessert=$errorDispoSandwich=$errorDispoBoisson=$errorDispoDessert=$errorHeureChoix = "";
    //vérification des champs, si les champs ne sont pas sélectionnés -> impossibilité de réserver
    if(empty($_POST['sandwich']))
    {  
        $errorSandwich = "Choisissez un sandwich. ";
        $isSuccessEmptySandwich = false;
    }
    else{
        $isSuccessEmptySandwich = true;
    }

    if(empty($_POST['boisson']))
    {  
        $errorBoisson = "Choisissez une boisson. ";
        $isSuccessEmptyBoisson = false;
    }
    else{
        $isSuccessEmptyBoisson = true;
    }

    if(empty($_POST['dessert']))
    {  
        $errorDessert = "Choisissez un dessert. ";
        $isSuccessEmptyDessert = false;
    }
    else{
        $isSuccessEmptyDessert = true;
    }


    if(empty($_POST['heure']))
    {
        $errorHeureChoix = "Veuillez choisir une heure de livraison. ";
        $isSuccessEmptyHeure = false;
    }
    else{
        $isSuccessEmptyHeure = true;
    }

    if($isSuccessEmptyBoisson == true and $isSuccessEmptyDessert == true and $isSuccessEmptySandwich == true and $isSuccessEmptyHeure == true)
    {
        $isSuccessEmpty = true;
    }
    else{
        $isSuccessEmpty = false;
    }
?>