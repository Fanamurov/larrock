<?php
/* *****************
* DEFAULT SETTINGS *
****************** */
$debug='0';
$debug_split_query_data_print='3';
$run_from_cmd='0';
$output_variant_trans_id='1';
$unix_path="/var/www/santa-avia.ru/data/ssl/";
$wind_path=":\\php_tsp_id\\tsp\\";
$tsp_id="9294710512";
$tsp_key="9294710512.key";
$tsp_pem="9294710512.pem";
$crt_chain="chain-ecomm-ca-root-ca.crt";
$client_ip="37.48.66.196";
$opt_v_curr = "643";
$opt_v_amou = "123123";
$opt_v_amou_ret = "";
$opt_v_lang = "ru";
$opt_v_comm = "v";
$opt_ij_pan = "1234000012340000";
$opt_ij_exp = "1506";
$opt_ij_name = "TEST CARD";
$opt_ij_cvv = "196";
$trans_id="111111111222222222333333333=";
/* ******************
* CURLOPT_INTERFACE *
* http://www.php.net/manual/ru/function.curl-setopt.php *
******************* */
$host_loc_curl_interface="";
/* *****************
* CUSTOME SETTINGS *
****************** */
$custom_settings_file = 'curl_settings.php';
if(file_exists($custom_settings_file)){
	include_once($custom_settings_file);
	$custom_settings='1';
}else{
	$custom_settings='0';
}
/* ****************
* DON'T CHANGE   *
* ANYTHING BELOW *
* THIS BLOCK     *
**************** */
$version="* Version: 0275 / Build: 2013.05.15 *";
$host_loc_url="https://testsecurepay.rsb.ru/ecomm2/ClientHandler?trans_id=";
$host_rem_url="https://testsecurepay.rsb.ru:9443/ecomm2/MerchantHandler";
$html_in = array('/\+/', '/=/', '/\//');
$html_out = array('%2B', '%3D', '%2F');
$log_out = array('\+', '=', '/');
if($trans_id){
	$trans_html_id = preg_replace($html_in,$html_out,$trans_id);
	$trans_log_id = preg_replace($html_in,$log_out,$trans_id);
}
$data_start = date("Y-m-d H:i:s e");
$data_start = date("Y-m-d H:i:s T");
$data_RFC2822 = "*  ".date("r")."  *";
if($run_from_cmd){
	$new_line="\n";
}else{
	$new_line="<br>";
}
if(!$host_loc_curl_interface && isset($_SERVER['SERVER_ADDR'])){
	$server_ip=''; $server_ip = "*  Server IP: ".$_SERVER['SERVER_ADDR']."";
}elseif($host_loc_curl_interface && isset($_SERVER['SERVER_ADDR'])){
	$server_ip=''; $server_ip = "*  Server IP: ".$_SERVER['SERVER_ADDR']." / CURLOPT_INTERFACE: ".$host_loc_curl_interface."";
}elseif($host_loc_curl_interface && !isset($_SERVER['SERVER_ADDR'])){
	$server_ip=''; $server_ip = "*  CURLOPT_INTERFACE: ".$host_loc_curl_interface."";
}else{
	$server_ip='';
}
if(!$client_ip && isset($_SERVER['REMOTE_ADDR'])){$client_ip = $_SERVER['REMOTE_ADDR'];}
if(!$client_ip){$client_ip="0.0.0.0";}
if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
if($debug>'3'){print $version;}
if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
if($debug>'3'){print $data_RFC2822;}
if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
if($debug>'3' && $server_ip){print "".$new_line."*************************************".$new_line."";}
if($debug>'3' && $server_ip){print $server_ip;}
if($debug>'3' && $server_ip){print "".$new_line."*************************************".$new_line."";}
if($custom_settings){
	if($debug>'5'){print "".$new_line."*************************************".$new_line."*   STARTING WITH CUSTOM SETTINGS   *".$new_line."*************************************".$new_line."";}
}else{
	if($debug>'5'){print "**********************************".$new_line."* STARTING WITH DEFAULT SETTINGS *".$new_line."**********************************".$new_line."";}
}
if($run_from_cmd){
	if(preg_match('@^([CDE]){1}@',$argv[1])){
		$use_disk = $argv[1];
		$file_key = $use_disk.$wind_path.$tsp_key;
		$file_pem = $use_disk.$wind_path.$tsp_pem;
		$file_cai = $use_disk.$wind_path.$crt_chain;
	}else{
		print "".$new_line."***************************".$new_line."";
		print "!!!       WARNING       !!!".$new_line."!!! NO LOCAL DISK FOUND !!!";
		print "".$new_line."***************************".$new_line."";
		exit;
	}
	if($debug>'5'){print "".$new_line."************************************************************".$new_line."";}
	if($debug>'5'){print "* DISK: [$use_disk] *".$new_line."";}
}else{
		$file_key = $unix_path.$tsp_key;
		$file_pem = $unix_path.$tsp_pem;
		$file_cai = $unix_path.$crt_chain;
}
if($debug>'5'){print "* ".$file_key."".$new_line."* ".$file_pem."".$new_line."* ".$file_cai;}
if($debug>'5'){print "".$new_line."************************************************************".$new_line."";}

//$opv_v_desc="Client's IP-address: [".$client_ip."] Date%26Time: [".$data_start."] Операция № Test";
$opv_v_desc='Номер тура: 1111'/*"IP: [".$client_ip."] DateTime: [".$data_start."] Operation # Test"*/;
//$opv_v_desc="IP: [".$client_ip."] DateTime: [".$data_start."] Операция # Test";

if($opt_v_comm == "v"){
	$query_data ="command=".$opt_v_comm;
	$query_data.="&amount=".$opt_v_amou;
	$query_data.="&description=".$opv_v_desc;
	$query_data.="&language=".$opt_v_lang;
	$query_data.="&currency=".$opt_v_curr;
}
if($opt_v_comm == "a"){
	$query_data ="command=".$opt_v_comm;
	$query_data.="&amount=".$opt_v_amou;
	$query_data.="&description=".$opv_v_desc;
	$query_data.="&language=".$opt_v_lang;
	$query_data.="&currency=".$opt_v_curr;
}
if(preg_match('@^([c]){1}@',$opt_v_comm)){
	$query_data ="command=".$opt_v_comm;
	$query_data.="&trans_id=".$trans_html_id;
}
if(preg_match('@^([rk]){1}@',$opt_v_comm)){
	$query_data ="command=".$opt_v_comm;
	$query_data.="&trans_id=".$trans_html_id;
	if($opt_v_amou_ret){
		$query_data.="&amount=".$opt_v_amou_ret;
	}
}
if(preg_match('@^([t]){1}@',$opt_v_comm)){
	$query_data ="command=".$opt_v_comm;
	$query_data.="&trans_id=".$trans_html_id;
	$query_data.="&amount=".$opt_v_amou;
	$query_data.="&currency=".$opt_v_curr;
}
if(preg_match('@^([g]){1}@',$opt_v_comm)){
	$query_data ="command=".$opt_v_comm;
	$query_data.="&trans_id=".$trans_html_id;
	$query_data.="&amount=".$opt_v_amou;
}
if(preg_match('@^([ij]){1}@',$opt_v_comm)){
	$query_data ="command=".$opt_v_comm;
	$query_data.="&pan=".$opt_ij_pan;
	$query_data.="&expiry=".$opt_ij_exp;
	$query_data.="&cvv2=".$opt_ij_cvv;
	$query_data.="&currency=".$opt_v_curr;
	$query_data.="&amount=".$opt_v_amou;
	$query_data.="&cardname=".$opt_ij_name;
}
if($opt_v_comm == "b"){
	$query_data ="command=".$opt_v_comm;
}
if($opt_v_comm){
	$query_data.="&server_version=2.0";
	$query_data.="&client_ip_addr=".$client_ip;
}else{
		print "".$new_line."************************".$new_line."
		!!!      WARNING     !!!
		".$new_line.
		"!!! NO COMMAND FOUND !!!"
		.$new_line."************************".$new_line."";
		exit;
}

if($debug>'5'){
	print "".$new_line."**********************".$new_line."";
	print "* FINAL QUERY STRING *";
	print "".$new_line."".$new_line."";
	if($debug_split_query_data_print=='1'){
		print "".preg_replace("@&@",$new_line,$query_data)."";
	}elseif($debug_split_query_data_print=='2'){
		$query_data_print=preg_replace("@&@",$new_line,$query_data);
		print "".$query_data_print."";
		print "".$new_line."".$new_line."";
		print "".$query_data."";
	}elseif($debug_split_query_data_print=='3'){
		$query_data_print=preg_replace("@&@",$new_line,$query_data);
		$query_data_print=preg_replace("@\=@"," = > ",$query_data_print);
		print "".$query_data_print."";
		print "".$new_line."".$new_line."";
		print "".$query_data."";
	}else{
		print "".$query_data."";
	}
	print "".$new_line."**********************".$new_line."";
}
$ch = curl_init();
if($debug>'10'){print "".$new_line."***************************".$new_line."* CURL DEBUG STRING START *".$new_line."***************************".$new_line."".$new_line."";}
if($debug>'10'){curl_setopt($ch, CURLOPT_VERBOSE, 1);}
if($host_loc_curl_interface){
	curl_setopt($ch, CURLOPT_INTERFACE, $host_loc_curl_interface);
}
curl_setopt($ch, CURLOPT_URL, $host_rem_url);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_USERAGENT, "User-Agent=Mozilla/5.0 Firefox/1.0.7");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSLKEY, $file_key);
curl_setopt($ch, CURLOPT_SSLCERT, $file_pem);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
curl_setopt($ch, CURLOPT_CAINFO, $file_cai);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result_curl = curl_exec($ch);
curl_close($ch);
if($debug>'10'){print "".$new_line."*************************".$new_line."* CURL DEBUG STRING END *".$new_line."*************************".$new_line."";}
if(preg_match('@^(TRANSACTION_ID): ([^.]+)$@i',$result_curl,$result_ok)){
	$result_ok_html[2] = preg_replace($html_in,$html_out,$result_ok[2]);
	$result_ok_log[2] = preg_replace($html_in,$log_out,$result_ok[2]);
	if($output_variant_trans_id=='1'){
		echo $result_ok[2];
	}elseif($output_variant_trans_id=='2'){
		echo $result_ok_html[2];
	}elseif($output_variant_trans_id=='3'){
		if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
		echo $result_ok[2];
		print "".$new_line."*************************************".$new_line."";
		echo $result_ok_html[2];
		if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
	}elseif($output_variant_trans_id=='4'){
		if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
		echo $host_loc_url.$result_ok_html[2];
		if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
	}elseif($output_variant_trans_id=='5'){
		if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
		echo $result_ok[2];
		print "".$new_line."*************************************".$new_line."";
		echo $result_ok_log[2];
		print "".$new_line."*************************************".$new_line."";
		echo $host_loc_url.$result_ok_html[2];
		if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
	}
}else{
	if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
	echo $result_curl;
	if($debug>'3'){print "".$new_line."*************************************".$new_line."";}
}
if($debug>'5'){print "".$new_line."*******".$new_line."* END *".$new_line."*******";}
?>