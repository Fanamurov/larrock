<?php
require_once 'settings.php';
$query = "SELECT * FROM $SQLdbname.`sletatTemplate` where `id`='".$_POST['id']."'";
$array = mysql_query($query, $SQLconnect);
$row=mysql_fetch_array($array);
echo $row['toursObject'];