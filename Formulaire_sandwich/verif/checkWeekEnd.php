<?php
    $isSuccessWeekEnd = false;
    if ($jourInterdit == 6 OR $jourInterdit == 0)
    {
        $isSuccessWeekEnd = false;
        $errorWeekend = "Vous ne pouvez pas commander pour un jour de week end"; 
    }
        
    else
    {
        $isSuccessWeekEnd = true;
    }
?>