<?php

function getWeather($lat,$lon) {
    $sent = curl_init();
    $url = "https://data.tmd.go.th/nwpapi/v1/forecast/location/hourly/at";
    
	curl_setopt($sent,CURLOPT_URL,$url);
	curl_setopt($sent,CURLOPT_CUSTOMREQUEST,"GET");
	
	$arrayheader = array();
	$arrayheader[] = "Content-Type: application/json";
    $arrayheader[] = "Authorization: Bearer {$tmdAccesstoken}";
    
    $postData = array(
        'lat' => $lat,
        'lon' => $lon,
        'fields' => 'tc,rh,rain,cond',
        'duration' => 48
    );

	curl_setopt($sent,CURLOPT_HTTPHEADER,$arrayheader);
	curl_setopt($sent,CURLOPT_POSTFIELDS,json_encode($postData));
	curl_setopt($sent,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($sent, CURLOPT_SSL_VERIFYPEER, false);
    $content = curl_exec($sent);
    $contentJson = json_decode($content);
    print_r($contentJson->WeatherForecasts[0]->forecasts);
    
    return $contentJson->WeatherForecasts[0]->forecasts;
    curl_close($sent);
}
?>