<?php
require_once 'settings.php';
$query = "DELETE FROM $SQLdbname.`sletatTemplate` WHERE `id`='".$_POST['id']."'";
mysql_query($query, $SQLconnect);
