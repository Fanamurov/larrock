<?php
$loginSletat = 'paltsev@santa-avia.ru';
$passwordSletat = 'asdfg098';
//$loginSletat = 'kd@corp.sletat.ru';
//$passwordSletat = '**';
$objPath = "/home/c/cu68070/santa-avia.ru/public_html/sletat/tours";

$SQLhost = 'localhost';
$SQLlogin = 'cu68070_texterra';
$SQLpassword = 'TRPXFeDj';
$SQLdbname = 'cu68070_texterra';

$SQLconnect = mysql_connect($SQLhost, $SQLlogin, $SQLpassword);
mysql_select_db($SQLdbname, $SQLconnect);
if (!$SQLconnect) {
    die('Ошибка соединения: ' . mysql_error());
}
mysql_query('SET NAMES utf8',$SQLconnect);
