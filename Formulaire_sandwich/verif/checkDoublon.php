<?php

    $query = $co->prepare('SELECT date_heure_livraison_com, id_com FROM commande WHERE fk_user_id = :id_user LIMIT 8');
    $query->bindParam(':id_user', $_SESSION['id_user']);
    $query->execute();

    $temp = $temp2 = array();
    $ind = 0;
    $recupDate = $TimeStampDateRecup = "";
    $isSuccessDoublon = false;
    while($result = $query->fetch()) //stock les résultats de la requete dans un tableau temporaire        
    {
        $recupDateHeure = $result[0];
        $TimeStampDateRecup = strtotime($recupDateHeure);
        $dateFormat = date('Y-m-d', $TimeStampDateRecup);
        $temp[$ind] = $dateFormat;
        $temp2[$ind] = $result[1];
        $ind++;
    }
    $ind = 0;

    foreach($temp as $value)
    {
        if($value == $_SESSION['date'])
        {
            $isSuccessDoublon = true;
            $_SESSION['id_com'] = $temp2[$ind];
        }
        $ind++;
    }





?>