<?php
require_once 'settings.php';
$query = "SELECT * FROM $SQLdbname.`sletatTemplate`  WHERE `id` = ".$_POST['id']."";
$array = mysql_query($query, $SQLconnect);
$row=mysql_fetch_array($array);
$data = json_encode($row);
echo $data;