<?php
//Vérification du changement non voulu de value dans l'html par un utilisateur du site
    
    $temp = array();
    $ind = 0;
    $isSuccessValue=$isSuccessValueSandwich=$isSuccessValueBoisson=$isSuccessValueDessert = false;
    $isSuccessValueChips = $isSuccessValueDate = $isSuccessValueHeure = false;


    $query = $co->prepare("SELECT id_sandwich from sandwich");
    $query->execute(); //selectionne les id sandwich dans la bdd
    if($isSuccessEmpty == true)
    {
        while($result = $query->fetch()) //stock les résultats de la requete dans un tableau temporaire        
       {
            $temp[$ind] = $result[0];
            $ind++; 
        }
        
        foreach($temp as $value) //compare les résultats contenue dans le tableau avec la value renvoyer lors de la validation du formulaire.
        {
            if($value == $sandwich)
            {
            $isSuccessValueSandwich = true;
            }
        }
        $ind=0;

        $query = $co->prepare("SELECT id_dessert from dessert");
        $query->execute(); //selectionne les id dessert dans la bdd
        
        while($result = $query->fetch()) //stock les résultats de la requete dans un tableau temporaire        
        {
            $temp[$ind] = $result[0];
            $ind++; 
        }
        
        foreach($temp as $value) //compare les résultats contenue dans le tableau avec la value renvoyer lors de la validation du formulaire.
        {
            if($value == $dessert)
            {
            $isSuccessValueDessert = true;
            }
        }
        $ind=0;

        $query = $co->prepare("SELECT id_boisson from boisson");
        $query->execute(); //selectionne les id boisson dans la bdd
        
        while($result = $query->fetch()) //stock les résultats de la requete dans un tableau temporaire        
        {
            $temp[$ind] = $result[0];
            $ind++; 
        }
        
        foreach($temp as $value) //compare les résultats contenue dans le tableau avec la value renvoyer lors de la validation du formulaire.
        {
            if($value == $boisson)
            {
            $isSuccessValueBoisson = true;
            }
        }
        $ind=0;

        if($reservationHour == '11:40' or $reservationHour == '12:35' or $reservationHour == '')
        {
            $isSuccessValueHeure = true;
        }
    
    }

        if($chips == 1 or $chips == 0)
        {
            $isSuccessValueChips = true;
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
