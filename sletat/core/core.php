<?php
require_once 'settings.php';
mysql_close($SQLconnect);
$auth = $_POST['auth'] ? '&login='.$loginSletat.'&password='.$passwordSletat: '';
$method = $_POST['method'];
$str = '?';
foreach($_POST as $key=>$value){
    $str .= '&'.$key.'='.$value;
}
$str = urldecode($str);
$json = file_get_contents('http://module.sletat.ru/Main.svc/'.$method.$str.$auth);
//echo 'http://module.sletat.ru/Main.svc/'.$method.$str.$auth;
echo $json;
