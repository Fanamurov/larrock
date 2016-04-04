<?php
require_once 'core/settings.php';
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

$citi = '';
if(isset($_POST['citi']))$citi = implode(",", $_POST['citi']);


$query = "INSERT INTO $SQLdbname.`template` (`id`, `townId`, `townName`, `countryId`, `countryName`, `citiesId`, `minNight`, `maxNight`, `dataRangeType`, `dataRangeMin`, `dataRangeMax`, `starsId`, `mealsId`, `hotelStop`, `ticketsInclud`, `hasTickets`, `maxTourPrice`, `discount`, `toursObject`) VALUES (NULL, '832', 'Москва', '40', 'Египет', '', '7', '14', 'rangeDate', '0', '7', '', '', 'on', 'on', 'on', '50000', '10', '{data:''qewr''}');";
mysql_query($query, $SQLconnect);