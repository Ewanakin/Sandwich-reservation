<?php
    $isSuccessHeure = false;
    if($reservationDate == $dt AND $HeureActuel >= $heureL )
    {
        $isSuccessHeure = false;
        $errorHeure = "Vous ne pouvez pas commander après 9h30 pour le jour même";
    }

    else
    {
        $isSuccessHeure = true;
    }

?>