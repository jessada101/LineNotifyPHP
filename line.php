<?php
$message = "YOUR_TEXT_HERE";
$lineapi = "YOUR_TOKEN_HERE";
line_notify($message,$lineapi);

function line_notify($message,$lineapi){
	$mms =  trim($message);
	$chOne = curl_init();
	curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
	curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($chOne, CURLOPT_POST, 1);
	curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
	curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
	$headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'',);
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($chOne);
	if(curl_error($chOne)){
		echo 'error:' . curl_error($chOne);
	}else{
		$result_ = json_decode($result, true);
		echo "status : ".$result_['status'];
		echo "message : ". $result_['message'];
	}
	curl_close($chOne);
}
?>