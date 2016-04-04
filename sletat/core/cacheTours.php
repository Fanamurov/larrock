<?php
require_once 'settings.php';
function cleanDir($dir) {
    $files = glob($dir."/*");
    $c = count($files);
    if (count($files) > 0) {
        foreach ($files as $file) {      
            if (file_exists($file)) {
            unlink($file);
            }   
        }
    }
}
cleanDir($objPath);
//echo $objPath;
//echo '<br>'.$_SERVER['DOCUMENT_ROOT'];
error_reporting(E_ALL);
ini_set('display_errors', 1);
$today = date('d.m.Y');
$query = "SELECT * FROM $SQLdbname.`sletatTemplate`";
$array = mysql_query($query, $SQLconnect);

$requests = array();

while($row=mysql_fetch_array($array)){
    if($row['state'] == 'disabled')continue;
    if($row['dataRangeType']=== 'nextDate'){
        $date1 = $today;
        $date2 = strtotime($today . "+".$row['dataRangeMax']." day");
        $date2 = date('d.m.Y',$date2);
    }elseif($row['dataRangeType']=== 'rangeDate'){
        
        $date1 = $row['dataRangeMin'];
        $date2 = $row['dataRangeMax'];
        if(strtotime($date2)<strtotime($today)){
            continue;
        }
    }elseif($row['dataRangeType']=== 'rangeToday'){
        $mindate = $row['dataRangeMin'];
        $maxdate = $row['dataRangeMax'];
        
        if($maxdate>$mindate+43){
            $maxdate = $mindate+43;
        }
        $date1 = strtotime($today . "+".$mindate." day");
        $date2 = strtotime($today . "+".$maxdate." day");
        $date1 = date('d.m.Y',$date1);
        $date2 = date('d.m.Y',$date2);
    }
$date1 = str_replace('.','/',$date1);
$date2 = str_replace('.','/',$date2);
$searchParam = array(
	'countryId'=>$row['countryId'],
	'cityFromId'=>$row['townId'], 
	'stars'=>'402,403,404,405,406,410,411',
	's_nightsMin'=>$row['minNight'],
	's_nightsMax'=>$row['maxNight'],
	//'currencyAlias'=>'RUB',
	's_departFrom'=>$date1,
	's_departTo'=>$date2,
	//'includeDescriptions'=>'false',
);
echo "<pre>";
print_r($row);
	echo "</pre>";
	//print_r($row);
if($row['mealsId'] != '')$searchParam['meals'] = $row['mealsId'];
if($row['citiesId'] != '---')$searchParam['cities'] = $row['citiesId'];
if($row['maxTourPrice'] != '0')$searchParam['s_priceMax'] = $row['maxTourPrice'];
if($row['hotelStop'] != '')$searchParam['s_hotelIsNotInStop'] = 'true';
if($row['ticketsInclud'] != '')$searchParam['s_ticketsIncluded'] = 'true';
if($row['hasTickets'] != '')$searchParam['s_hasTickets'] = 'true';
$method = 'GetTours?';
$auth = "&login=$loginSletat&password=$passwordSletat";
$str = 'http://module.sletat.ru/Main.svc/'.$method.http_build_query($searchParam).$auth.'&pageSize=300';
	//&requestId=938703506&updateResult=1
	echo "str: $str <br>";
$json = file_get_contents($str);
$json = json_decode($json);
echo "<pre>";
print_r ($json);
	echo "</pre>";
$requests[$row['id']] = $str.'&requestId='.$json->GetToursResult->Data->requestId.'&updateResult=1';

$res_string = $str.'&requestId='.$json->GetToursResult->Data->requestId.'&updateResult=1';
	echo "Res String: $res_string <br>";
	echo $row['id'];
	$dk_query = "UPDATE $SQLdbname.`sletatTemplate` SET `res_string`='".$res_string."' WHERE `id` ='".$row['id']."'";
echo "$dk_query";
mysql_query($dk_query, $SQLconnect);
$discount[$row['id']] = (!empty($row['discount']))?100-(int)$row['discount']:100;
	sleep(2);
}
//sleep(3);
//foreach ($requests as $key=>$value){
//        $file = "$objPath/$key.js";
//$json = file_get_contents($value);
//	//$json = json_decode($json);
//$hotels = array();
//foreach($json->GetToursResult->Data->aaData as $k => $v){
//	if(empty($v[29])){
//		unset($json->GetToursResult->Data->aaData[$k]);
//	}
//	if (in_array($v[3], $hotels)){
///		unset($json->GetToursResult->Data->aaData[$k]);
//		continue;
//	}else{
//		$hotels[] = $v[3];
//	}
//}
	//$json = json_encode($json);
//file_put_contents($file, "sletatTemplate = $json;sletatDiscount=$discount[$key]");
//	echo "<pre> TO FILE:";
//print_r($json);
//	echo "</pre>";
//}