<?php
//Vérification du changement non voulu de value dans l'html par un utilisateur du site
$isSuccessValueDate = $isSuccessValueHeure = false;



    if($reservationHour == '11:40' or $reservationHour == '12:35' or $reservationHour == '')
    {
        $isSuccessValueHeure = true;
    }

    function isValid($dateVerif, $format = 'Y-m-d'){
        $verifdt = DateTime::createFromFormat($format, $dateVerif);
        return $verifdt && $verifdt->format($format) === $dateVerif;
    }
    
    $isSuccessValueDate = isValid($reservationDate);



    if($isSuccessEmpty == true)
    {
        if($isSuccessValueSandwich == true and $isSuccessValueDessert == true and $isSuccessValueBoisson == true and $isSuccessValueHeure == true and $isSuccessValueChips == true and $isSuccessValueDate == true)
        {
            $isSuccessValue = true;
        }
        else
        {
            $isSuccessValue = false;
            $ErrorValue = "Ne changez pas la valeur dans le code";
        }
    }
    
?>
