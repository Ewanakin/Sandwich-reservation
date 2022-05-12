<?php
        $isSuccessDateAnt = false;
        $isSuccessDateSupp = false;
        if($reservationDate < $dt)
        {
            $isSuccessDateAnt = false;
            $errorDate = "Vous ne pouvez pas commander à une date déjà passé";
        }
        else
        {
            $isSuccessDateAnt = true;
        }

        $semaineLimite = date('Y-m-d', strtotime($dt.'+ 7 days'));
        
        if($reservationDate > $semaineLimite)
        {
            $isSuccessDateSupp = false;
            $errorDateSupp = "Vous ne pouvez pas commander à plus d'une semaine d'intervalle.";
        }
        else
        {
            $isSuccessDateSupp = true;
        }

?>