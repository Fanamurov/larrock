<?php
require_once 'settings.php';
mysql_close($SQLconnect);

if(!is_numeric($_GET['offerId']) || !is_numeric($_GET['sourceId']) || !is_numeric($_GET['requestId'])){
    exit();
}

$soapClient = new SoapClient('http://module.sletat.ru/XmlGate.svc?wsdl');

$soapClient->__setSoapHeaders(new SoapHeader("urn:SletatRu:DataTypes:AuthData:v1", "AuthInfo", array(
    "Login" => $loginSletat,
    'Password'=> $passwordSletat
)));

$searchParam = array(
    'requestId' => $_GET['requestId'],
    'sourceId' => $_GET['sourceId'],
    'offerId' => $_GET['offerId']
);

$result = $soapClient->ActualizePrice($searchParam);
$TourInfo = $result->ActualizePriceResult->TourInfo;
$result = $result->ActualizePriceResult;
echo '<pre>';
print_r($result);
if($TourInfo->TicketsIncluded === 'Included'){
    $fly= ' авиаперелёт,';
}else{
    $fly = '';
}

$str = <<<EOF
		<div id="kartochka-wrapper">
		<div class="kartochka-wrapper clearfix">
			<div class="block-top clearfix">
			<span class="tur">Тур №->RandomNumber</span> 
				<span class="red">$TourInfo->CityFromName</span>
				<span class="fly"></span>
				<span class="red">$TourInfo->CountryName</span>
			</div>
			<div class="block_table_bar">
				<table class="table_info">
					<tr>
						<td class="bold">Вылет:</td>
						<td>$TourInfo->CheckIn</td>
					</tr>
					<tr>
						<td class="bold">Обратно:</td>
						<td>$TourInfo->CheckOut</td>
					</tr>
					<tr>
						<td class="bold">Кол-во ночей:</td>
						<td>$TourInfo->Nights</td>
					</tr>
					<tr>
						<td class="bold">Номер:</td>
						<td>$TourInfo->RoomName<span>$TourInfo->SysHtPlaceName</span></td>
					</tr>
					<tr>
						<td class="bold">Питание:</td>
						<td>$TourInfo->SysMealName<span>$TourInfo->SysMealName</span></td>
					</tr>
				</table>
        <div id="kartochka_primechanie" class="clearfix">
				<span>Перелет туда</span>
				<span class="p-arr p-arr_">Есть</span>
				<span class="p-arr_u">Перелет обратно</span>
				<span class="p-arr p-arr_arr">Есть</span>
				<span class="p-arr_u1">Места в отеле</span>
				<span class="p-arr last">Есть</span>
				<div class="primechanie">
					<div class="primechanie_img"></div>
					<div class="primechanie_text">
						В стоимость входит$fly проживание, трансфер, питание, медицинская <br>страховка, услуги гида, страхование ответственности туроператора
					</div>
				</div>
			</div>
			</div>
			<div class="block_price position">
					<div class="price">
						<span class="price_tur">Цена тура:</span>
						<span class="price_">$TourInfo->Price руб.</span>
					</div>
					<div class="blokc_doplaty">
						<span class="doplaty">доплаты:</span>
EOF;

if(isset($result->VisasExtendInfo->VisaSurchargeExtendInfo[0])){
    $maxVisa = $result->VisasExtendInfo->VisaSurchargeExtendInfo[0]->Price;
    $minVisa = $result->VisasExtendInfo->VisaSurchargeExtendInfo[0]->Price;
        foreach($result->VisasExtendInfo->VisaSurchargeExtendInfo as $key => $val){
            if($val->Price > $maxVisa)$maxVisa = $val->Price;
            if($val->Price < $minVisa)$minVisa = $val->Price;
        }
$curVisa = $result->VisasExtendInfo->VisaSurchargeExtendInfo[0]->CurrencyName;
echo '<span class="no_doplaty">Виза '.$minVisa.' - '.$maxVisa.' '.$curVisa.'</span><br>';
}
if(isset($result->OilTaxes->XmlOilTax)){
    if(is_array($result->OilTaxes->XmlOilTax)){
        $maxOil = $result->OilTaxes->XmlOilTax[0]->Tax;
        foreach($result->OilTaxes->XmlOilTax as $key => $val){
                    if($val->Tax > $maxOil)$maxOil = $val->Tax;
                    if(isset($val->CurrencyName))$curOil = $val->CurrencyName;
                }
        }
    }else {
    $maxOil = $result->OilTaxes->XmlOilTax->Tax;
    $curOil = $result->OilTaxes->XmlOilTax->CurrencyName;
    }
if(isset($curOil)){
    echo '<span class="no_doplaty">Топливо '.$maxOil.' '.$curOil.'</span>';
}
if(!isset($curOil) && !isset($curVisa)){
   echo '<span class="no_doplaty">Нет информации</span>'; 
}
$str2 = <<<EOD
        
						
					</div>
					<div id="form-online">
						<span class="button3"><img src="images/button3.png"></span>
					</div>
					<div id="form-ofice" class="clearfix">
						<span class="button2"><img src="images/button4.png"></span>
					</div>
				</div>
		</div>
        <div class="block-country-wrapper">
			<div id="wrapper-bron">
        			<form>
			<div class="title">Забронировать этот тур</div>
			<div class="title-turist">Туристы:</div>

EOD;
for ($i = 0;$i<$_GET['pCount'];$i++){
echo '

			<div class="bron-form">
				<div class="bron-form1 clearfix">
					<p class="first">
						<span>Имя(латиницей):</span>
						<input type="text" name="name'.$i.'" class="bron" id="name">
					</p>
					<p>
						<span>Фамилия(латиницей):</span>
						<input type="text" name="lastname'.$i.'" class="bron" id="lastname">
					</p>
					<p class="nationality">
						<span>Гражд:</span>
						<input type="text" name="nationality'.$i.'" class="bron_" id="nationality">
					</p>
					<p class="sex_arr">
						<span>Пол:</span>
						<div class="new-select-style-wpandyou_">
							<select class="chosen-select-no-single chosen-select-no-single_" name="sex'.$i.'" tabindex="9">
							<option>муж</option>
							<option>жен</option>
						</select>
						</div>
					</p>
					<p class="first">
						<span>Дата рождения:</span>
						<input type="text" name="birthday'.$i.'" class="bron" id="birthday">
					</p>
					<p>
						<span>Серия и номер загранпаспорта:</span>
						<input type="text" name="series'.$i.'" class="bron_" id="series">
						<input type="text" name="num'.$i.'" class="bron_" id="num">
					</p>
					<p class="date-v">
						<span>Дата выдачи:</span>
						<input type="text" name="date'.$i.'" class="bron_" id="date">
					</p>
					<p class="srok-d">
						<span>Срок действия:</span>
						<div class="new-select-style-wpandyou_">
						<input type="text" name="srok'.$i.'" class="bron_" id="date">
						</div>
					</p>
				</div>
			</div>';
}
echo '			<div class="info-zakaz clearfix">
				<div class="title">Информация о заказчике:</div>
				<div class="form-zakaz clearfix">
					<p class="first">
						<span>ФИО:</span>
						<input type="text" name="fio" id="fio" class="zakaz">
					</p>
					<p class="adress">
						<span>Адрес:</span>
						<input type="text" name="adress" id="adress" class="zakaz">
					</p>
					<p class="first">
						<span>Телефон:</span>
						<input type="text" name="phone" id="phone" class="zakaz_">
					</p>
					<p class="email">
						<span>Email:</span>
						<input type="text" name="email" id="email" class="zakaz_">
					</p>
					<p>
						<span>Паспорт:</span>
						<input type="text" name="pasport" id="passport" class="zakaz_">
					</p>
				</div>
			</div>
			<input type="image" class="button7" src="images/button7.png">
			</form>';

echo '			<div class="radio1 clearfix">
				<input type="checkbox" class="r_button2" name="name" id="r_6">
				<label for="r_6">Я согласен с условиями <a class="oferta" href="#">оферты</a></label>
			</div>
			<p class="opisanie">
				После заказа тура менеджер турагенства проверит состав и стоимость тура у туроператора, затем отправит Вам по электронной почте виртуальный счет на оплату тура. Также вы получите СМС оповещение на указанный номер мобильного телефона. Оплату вы сможете произвести с помощью своей банковской карты.
			</p>
		</div>
		<div class="wrapper-ofice clearfix">
			<div class="title">Контактные данные:</div>
			<form class="clearfix">
				<div class="block-left">
					<p>
						<span class="arr name">Ваше имя</span><span class="arr_r">*</span>
						<input type="text" name="name" class="inpt">
					</p>
					<p>
						<span class="arr text">Текст</span><span class="arr_r">*</span>
						<input type="text" name="text" class="inpt">
					</p>
					<p>
						<span class="arr email">E-mail</span><span class="arr_r">*</span>
						<input type="text" name="email" class="inpt">
					</p>
				</div>
				<p class="clearfix textarea">
					<span class="arr comment">Комментарии</span>
					<textarea type="text" class="aria" cols="32" rows="4"></textarea>
				</p>
				<input type="image" class="button6" src="images/button6.png">
			</form>';
