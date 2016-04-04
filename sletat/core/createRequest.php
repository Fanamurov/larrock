<?php
require_once 'settings.php';
mysql_close($SQLconnect);

$soapClient = new SoapClient('http://module.sletat.ru/XmlGate.svc?wsdl');

$soapClient->__setSoapHeaders(new SoapHeader("urn:SletatRu:DataTypes:AuthData:v1", "AuthInfo", array(
    "Login" => $loginSletat,
    'Password'=> $passwordSletat
)));

$searchParam = array(
	'countryId'=>$_POST['country'],
	'cityFromId'=>$_POST['townFrom'], 
	'nightsMin'=>$_POST['nights'],
	'nightsMax'=>$_POST['nights']+7,
	'currencyAlias'=>'RUB',
	'includeDescriptions'=>'true',
        'adults'=>$_POST['adults'],
        'hotelIsNotInStop'=> true,
        'hasTickets'=> true,
        'ticketsIncluded'=>true
);
if($_POST['cities'] != 'all')$searchParam['cities'] = $_POST['cities'];
if($_POST['meal'] != 'all')$searchParam['meals'] = array( 0 => $_POST['meal']);
if($_POST['minPrice'] != '')$searchParam['priceMin'] = $_POST['minPrice'];
if($_POST['maxPrice'] != '')$searchParam['priceMax'] = $_POST['maxPrice'];
if($_POST['hotel'] != 'all')$searchParam['hotels'] = array( 0 => $_POST['hotel']);
if($_POST['cities'] != 'all')$searchParam['cities'] = array( 0 => $_POST['cities']);

if($_POST['stars'] != 'all'){
    
    if($_POST['stars'] == 1){
        $searchParam['stars'] = array(
            0 => '400'
        );
    }elseif($_POST['stars'] == 2){
        $searchParam['stars'] = array(
            0 => '401'
        );
    }elseif($_POST['stars'] == 3){
        $searchParam['stars'] = array(
            0 => '402'
        );
    }elseif($_POST['stars'] == 4){
        $searchParam['stars'] = array(
            0 => '403',
            1 => '410'
        );
    }elseif($_POST['stars'] == 5){
        $searchParam['stars'] = array(
            0 => '405',
            1 => '406',
            2 => '411',
            3 => '404'
        );
    }
    
}

if($_POST['departDay'] < 10){
    $date1 =  '0'.$_POST['departDay'];
}else{
    $date1 = $_POST['departDay'];
}
$month1 = $_POST['departMonth']+1;
if($_POST['departMonth'] < 10){
    $month1 =  '0'.$_POST['departMonth'];
}else{
    $month1 = $_POST['departMonth'];
}

$date1 = $date1.'.'.$month1.'.20'.$_POST['year'];
$date1 = strtotime($date1."+1 month");
$date1 = date('d.m.Y',$date1);
$date2 = strtotime($date1."+7 day");
$date2 = date('d.m.Y',$date2);
$searchParam['departFrom'] = $date1;
$searchParam['departTo'] = $date2;
$result = $soapClient->CreateRequest($searchParam);
$searchParam['requestId'] = $result->CreateRequestResult;
$quest = json_encode($searchParam);
echo $quest;
//echo $result->CreateRequestResult;