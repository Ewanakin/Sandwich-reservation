<?php
        if($reservationDate < $dt)
        {
            $isSuccess = false;
            $errorDate = "Vous ne pouvez pas commander à une date déjà passé";
        }
        else
        {
            $isSuccess = true;
        }

?>