<?php

function response($inputJson) {
	$arraypost = array();
	$arraypost["replyToken"] = $inputJson["events"][0]["replyToken"];
	return $arraypost;
}

function reply($accesstoken,$output) {
	$sent = curl_init();
    $url = "https://api.line.me/v2/bot/message/reply";
    
	curl_setopt($sent,CURLOPT_URL,$url);
	curl_setopt($sent,CURLOPT_CUSTOMREQUEST,"POST");
	
	$arrayheader = array();
	$arrayheader[] = "Content-Type: application/json";
    $arrayheader[] = "Authorization: Bearer {$accesstoken}";
    
	curl_setopt($sent,CURLOPT_HTTPHEADER,$arrayheader);
	curl_setopt($sent,CURLOPT_POSTFIELDS,json_encode($output));
	curl_setopt($sent,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($sent,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($sent, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($sent);

    curl_close($sent);
}

function get_event_type($inputJson) {
	return $inputJson["events"][0]["type"];
}

function get_message_type($inputJson) {
	return $inputJson["events"][0]["message"]["type"];
}

function get_message_text($inputJson) {
	return $inputJson["events"][0]["message"]["text"];
}

function get_location($inputJson) {
	$message = $inputJson["events"][0]["message"];
	return array($message["latitude"],$message["longitude"]);
}

function add_text($output,$index,$text) {
	$output["messages"][$index]["type"] = "text";
	$output["messages"][$index]["text"] = $text;
	return $output;
}