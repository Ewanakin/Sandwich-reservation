<?php
    $isSuccessIndispo = false;

    $query = $co->prepare('SELECT dispo_sandwich FROM sandwich where id_sandwich=:id');
    $query->bindParam(':id', $sandwich);
    $query->execute();
    $result = $query->fetch();

    if($result[0] < 1 and !empty($sandwich))
    {
        $isSuccessIndispo = false;
        $errorDispoSandwich = "Le sandwich n'est pas disponible.";

    }
    else{
        $isSuccessIndispo = true;
    }

    $query = $co->prepare('SELECT dispo_boisson FROM boisson where id_boisson=:id');
    $query->bindParam(':id',$boisson);
    $query->execute();
    $result = $query->fetch();

    if($result[0] < 1 and !empty($boisson))
    {
        $isSuccessIndispo = false;
        $errorDispoBoisson = "La boisson n'est pas disponible.";
    }
    else{
        $isSuccessIndispo = true;
    }

    $query = $co->prepare('SELECT dispo_dessert FROM dessert where id_dessert=:id');
    $query->bindParam(':id', $dessert);
    $query->execute();
    $result = $query->fetch();

    if($result[0] < 1  and !empty($dessert))
    {
        $isSuccessIndispo = false;
        $errorDispoDessert = "Le dessert n'est pas disponible.";
    }
    else{
        $isSuccessIndispo = true;
    }

?>