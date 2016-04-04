<?php
require_once 'settings.php';
ini_set("display_errors", 1); 
error_reporting(E_ALL);

mysql_close($SQLconnect);

$soapClient = new SoapClient('http://module.sletat.ru/XmlGate.svc?wsdl');

$soapClient->__setSoapHeaders(new SoapHeader("urn:SletatRu:DataTypes:AuthData:v1", "AuthInfo", array(
    "Login" => $loginSletat,
    'Password'=> $passwordSletat
)));

$searchParam = array(
    'requestId' => $_GET['requestId']
);

$result = $soapClient->GetRequestResult($searchParam);
$result = json_encode($result);
echo $result;
