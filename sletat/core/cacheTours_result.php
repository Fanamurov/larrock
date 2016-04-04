<?php
require_once 'settings.php';

echo $objPath;
//echo '<br>'.$_SERVER['DOCUMENT_ROOT'];
error_reporting(E_ALL);
ini_set('display_errors', 1);
$today = date('d.m.Y');
$query = "SELECT * FROM $SQLdbname.`sletatTemplate` WHERE `state`!= 'disabled'";
$array = mysql_query($query, $SQLconnect);
//$rows = array();

$requests = array();
//$rows=mysql_fetch_array($array);
//print_r($rows);
while($roww=mysql_fetch_array($array)){

	//print_r($roww);
	//foreach ($rows as $row){
$discount = (!empty($roww['discount']))?100-(int)$roww['discount']:100;
$key = $roww['id'];
	//$discount = $roww['discount'];
echo $roww['id'];echo "<br>";
echo $roww['res_string'];echo "<br>";

$json = file_get_contents($roww['res_string']);
$json = json_decode($json);
$hotels = array();
foreach($json->GetToursResult->Data->aaData as $k => $v){
if(empty($v[29])){
// dk //
unset($json->GetToursResult->Data->aaData[$k]);
}
if (in_array($v[3], $hotels)){
// dk //
unset($json->GetToursResult->Data->aaData[$k]);
continue;
}else{
$hotels[] = $v[3];
}
}
$file = "$objPath/$key.js";
$json = json_encode($json);
file_put_contents($file, "sletatTemplate = $json;sletatDiscount=$discount");
echo "<pre> TO FILE: $file :";
print_r($json);
echo "</pre>";
sleep(0);
}