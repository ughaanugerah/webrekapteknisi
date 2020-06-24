<?php
    $orgDate = "17/07/2012";
    $date = str_replace('/', '-', $orgDate);
    $newDate = date("Y/m/d", strtotime($date));
    echo "New date format is: ".$newDate. " (YYYY/MM-DD)";
?>
