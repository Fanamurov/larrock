<?php
require_once 'settings.php';
$query = "SELECT * FROM $SQLdbname.`sletatTemplate`";
$array = mysql_query($query, $SQLconnect);
while($row=mysql_fetch_array($array)){
    echo '<div class="templatesRow">Id: <span class="templateId">'.$row['id'].'</span> <span class="desten">'.$row['townName'].'-->'.$row['countryName'].'-->'.$row['citiesname'].'</span><br></div><div class="deleteTemplate">X</div><div class="oneRow"></div>';
}