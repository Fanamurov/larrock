<?php
require_once 'settings.php';
error_reporting (0);

$query = "UPDATE $SQLdbname.`sletatTemplate` SET `state`='".$_POST['state']."' WHERE `id`='".$_POST['id']."'";
mysql_query($query, $SQLconnect);