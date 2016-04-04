<?php
require_once 'settings.php';
mysql_close($SQLconnect);

$soapClient = new SoapClient('http://module.sletat.ru/XmlGate.svc?wsdl');

$soapClient->__setSoapHeaders(new SoapHeader("urn:SletatRu:DataTypes:AuthData:v1", "AuthInfo", array(
    "Login" => $loginSletat,
    'Password'=> $passwordSletat
)));

$searchParam = array(
    'requestId' => $_POST['requestId'],
    'sourceId' => $_POST['sourceId'],
    'offerId' => $_POST['offerId'],
    'user' => $_POST['user'],
    'email' => $_POST['email'],
    'phone' => $_POST['phone'],
    'info' => $_POST['info']
);

$result = $soapClient->saveTourOrder($searchParam);