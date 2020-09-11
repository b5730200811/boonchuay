<?php

function getWeather($tmdAccesstoken,$lat,$lon) {
    $sent = curl_init();
    $url = "https://data.tmd.go.th/nwpapi/v1/forecast/location/hourly/at";
    
    $postData = array(
        'lat' => $lat,
        'lon' => $lon,
        'fields' => 'tc,rh,rain,cond',
        'duration' => 48
    );

    $url = $url . '?' . http_build_query($postData);

    echo "tmd=>".$tmdAccesstoken."<br/>";

	curl_setopt($sent,CURLOPT_URL,$url);
	curl_setopt($sent,CURLOPT_CUSTOMREQUEST,"GET");
	
	$arrayheader = array();
	$arrayheader[] = "Content-Type: application/json";
    $arrayheader[] = "Authorization: Bearer {$tmdAccesstoken}";
    curl_setopt($sent,CURLOPT_HTTPHEADER,$arrayheader);

	//curl_setopt($sent,CURLOPT_POSTFIELDS,json_encode($postData));
	curl_setopt($sent,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($sent, CURLOPT_SSL_VERIFYPEER, true);
    $content = curl_exec($sent);
    echo "<br/><br/>content<br/>";
    print_r($content);
    $contentJson = json_decode($content);
    curl_close($sent);
    return $contentJson;
}
print_r(getWeather($tmdAccesstoken,13.08,100.91));
?>