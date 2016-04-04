<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/sletat/core/settings.php';

$soapClient = new SoapClient('http://claims.sletat.ru/xmlgate.svc?wsdl');

$soapClient->__setSoapHeaders(new SoapHeader("urn:SletatRu:DataTypes:AuthData:v1", "AuthInfo", array(
    "Login" => $loginSletat,
    'Password'=> $passwordSletat
)));

foreach($_POST['FirstName'] as $key => $value){
    $tourist[$key]['FirstName'] = $value;
}
foreach($_POST['Surname'] as $key => $value){
    $tourist[$key]['Surname'] = $value;
}
foreach($_POST['nationality'] as $key => $value){
    $tourist[$key]['nationality'] = $value;
}
/*foreach($_POST['Title'] as $key => $value){
    $tourist[$key]['Title'] = $value;
}*/
foreach($_POST['BirthDate'] as $key => $value){
    $tourist[$key]['BirthDate'] = date('Y-m-d\TH:i:s',strtotime($value));
}
foreach($_POST['PassportSeries'] as $key => $value){
    $tourist[$key]['PassportSeries'] = $value;
}
foreach($_POST['PassportNumber'] as $key => $value){
    $tourist[$key]['PassportNumber'] = $value;
}
foreach($_POST['DateOfIssue'] as $key => $value){
    $tourist[$key]['DateOfIssue'] = date('Y-m-d\TH:i:s',strtotime($value));
}
foreach($_POST['Expires'] as $key => $value){
    $tourist[$key]['Expires'] = date('Y-m-d\TH:i:s',strtotime($value));
}
foreach($tourist as $key => $value){
	$tourist[$key] = (object) $value;
}

$castomer = (object) array (
                    'Address'=>$_POST['Address'],
                    'Email'=>$_POST['email'],
                    'FullName'=>$_POST['FullName'],
                    'Passport'=>$_POST['Passport'],
                    'Phone'=>$_POST['phone']
                    );
$request = array(
    'request' => array(
        'WorkflowType' => 'Preprocessing',
        'Customer'=> $castomer,
    'InitialURL'=>'http://www.santa-avia.ru/',
    'OfferId'=>$_POST['OfferId'],
    'RequestId'=>$_POST['RequestId'],
    'SourceId'=>$_POST['SourceId'],
    'Actualize'=>false,
            'Tourists'=> array(
                'Tourist' => $tourist
            )
        )
    );

if(isset($_POST['discount'])){
    $template = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/sletat/tours/'.$_POST['discount'].'.js');
    $template = substr_replace($template,null,0,17);
	$template = preg_replace('/;sletatDiscount=.*/', '', $template);
	$template = json_decode($template);
	foreach($template->GetToursResult->Data->aaData as $cachedTour){
        if($_POST['RequestId'] == $template->GetToursResult->Data->requestId && $cachedTour[0] == $_POST['OfferId'] && $cachedTour[1] == $_POST['SourceId']){
			$query = "SELECT discount FROM $SQLdbname.`sletatTemplate` WHERE id=".$_POST['discount'];
			$discount = mysql_query($query, $SQLconnect);
			$discount = mysql_fetch_row($discount);
			$request['request']['DiscountPercentage']=$discount[0];
        }
    }
}

try {
    $result = $soapClient->CreateClaim($request);
	print_r($request);
} catch (SoapFault $fault) {
	print_r($fault);
}

print_r($result);