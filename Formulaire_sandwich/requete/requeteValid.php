<?php
    $query = $co->prepare('SELECT nom_sandwich FROM sandwich WHERE id_sandwich=:sandwich');
    $query->bindParam(':sandwich', $sandwich);
    $query->execute();
    $Nomsandwich = $query->fetch();
    
    $query = $co->prepare('SELECT nom_boisson FROM boisson WHERE id_boisson=:boisson');
    $query->bindParam(':boisson', $boisson);
    $query->execute();
    $Nomboisson = $query->fetch();
    
    $query = $co->prepare('SELECT nom_dessert FROM dessert WHERE id_dessert=:dessert');
    $query->bindParam(':dessert', $dessert);
    $query->execute();
    $Nomdessert = $query->fetch();
?>