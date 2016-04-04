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

$query = "UPDATE $SQLdbname.`sletatTemplate` SET `townId`='".$_POST['townFrom']."', `townName`='".$_POST['townName']."', `countryId`='".$_POST['countryId']."', `countryName`='".$_POST['countryName']."', `citiesname`='".$_POST['citiesName']."', `citiesId`='".$_POST['cities']."', `minNight`='".$_POST['nightsMin']."', `maxNight`='".$_POST['nightsMax']."', `dataRangeType`='".$_POST['rangeType']."', `dataRangeMin`='".$date1."', `dataRangeMax`='".$date2."', `starsId`='".$stars."', `mealsId`='".$meals."', `hotelStop`='".$_POST['hotelStop']."', `ticketsInclud`='".$_POST['ticketsInclud']."', `hasTickets`='".$_POST['hasTickets']."', `maxTourPrice`='".$_POST['maxPrice']."', `discount`='".$_POST['discount']."' WHERE `id`='".$_POST['id']."'";

mysql_query($query, $SQLconnect);