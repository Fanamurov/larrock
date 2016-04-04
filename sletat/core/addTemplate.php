<?php
require_once 'settings.php';
error_reporting (0);
if($_POST['rangeType']==='nextDate'){
    $date1 = 'today';
    $date2 = $_POST['nextDate'];
}elseif($_POST['rangeType']==='rangeDate'){
    $date1 = $_POST['dateRange'][0];
    $date2 = $_POST['dateRange'][1];
}elseif($_POST['rangeType']==='rangeToday'){
    $date1 = $_POST['rangeToday1'];
    $date2 = $_POST['rangeToday2'];
}

if (count($_POST['meals'])===8){
    $meals = '';
}
else{
    $meals = implode(",", $_POST['meals']);
}

$stars = implode(",", $_POST['star']);

$query = "INSERT INTO $SQLdbname.`sletatTemplate` (`id`, `townId`, `townName`, `countryId`, `countryName`, `citiesId`, `citiesname`, `minNight`, `maxNight`, `dataRangeType`, `dataRangeMin`, `dataRangeMax`, `starsId`, `mealsId`, `hotelStop`, `ticketsInclud`, `hasTickets`, `maxTourPrice`, `discount`, `state`) "
        . "                       VALUES (NULL, '".$_POST['townFrom']."', '".$_POST['townName']."', '".$_POST['countryId']."', '".$_POST['countryName']."', '".$_POST['cities']."', '".$_POST['citiesName']."', '".$_POST['nightsMin']."', '".$_POST['nightsMax']."', '".$_POST['rangeType']."', '".$date1."', '".$date2."', '".$stars."', '".$meals."', '".$_POST['hotelStop']."', '".$_POST['ticketsInclud']."', '".$_POST['hasTickets']."', '".$_POST['maxPrice']."', '".$_POST['discount']."', 'enable');";
mysql_query($query, $SQLconnect);